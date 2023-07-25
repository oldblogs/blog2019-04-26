<template>
    <div>
        <input v-model="about.id" type="text" class="form-control" style="display: none" >

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h2 class="h2">About You</h2>
        </div>

        <div class="form-group">
            <label>Title</label>
            <input v-model="about.title" type="text" class="form-control" 
              aria-describedby="enter title for about record">
        </div>

        <div class="form-group">
            <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" 
              class="alert alert-danger">{{ item }}
            </div>
        </div>

        <div class="form-group">
            <label>Subtitle</label>
            <input v-model="about.subtitle" type="text" class="form-control" 
              aria-describedby="enter subtitle for about record">
        </div>

        <div class="form-group">
            <div v-show="errors.subtitle" v-for="item in errors.subtitle" v-bind:key="item" 
              class="alert alert-danger">{{ item }}
            </div>
        </div>

        <div class="form-group">
            <label>Content</label>
            <div class="mavonEditor">
              <mavon-editor :toolbars="markdownOption" v-model="about.body" aria-label="write your post here"></mavon-editor>
            </div>
        </div>

        <div class="form-group">
            <div v-show="errors.body" v-for="item in errors.body" v-bind:key="item" 
              class="alert alert-danger">{{ item }}
            </div>
        </div>

        <div class="form-group">
            <label>Photo</label>
            <div>
              <img v-if="about.photo" v-bind:src="photopath" v-bind:key="photopath" class="img-thumbnail" style="max-height: 6rem;" alt="Profile photo" title="" />
              <button class="btn btn-sm btn-outline-secondary" 
                v-if="about.photo" v-on:click="deletephoto" ><trash-2-icon class="custom-class"></trash-2-icon></button>
              <input type="file" id="file" ref="file" class="form-control-file" aria-describedby="choose a photo file" v-on:change="handleFileUpload"/>
            </div>
            
        </div>

        <div class="form-group">
            <div v-show="errors.photo" v-for="item in errors.photo" v-bind:key="item" 
              class="alert alert-danger">{{ item }}
            </div>
        </div>

        <div class="form-group">
            <button v-on:click="updateAbout" class="btn btn-primary">Save</button>
        </div>

        <div class="form-group" v-show="message">
            <div class="alert alert-danger">
              {{ message }}
            </div>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3"></div>

     </div>
</template>

<script>
  import { Trash2Icon  } from 'vue-feather-icons'

  export default {
    name: "About",

    mounted() {
      this.fetch()
    },

    data(){
      return{
        about: {
          type: Object,
          required: false,
          default: function(){
            return {
              id: 0,
              title: "",
              subtitle: "",
              body: "",
              photo: "",
              created_at: "00:00",
              updated_at: "00:00",
              index: -1,
            }
          },
        },
        photofile: {
          type: Object,
          required: false,
          default: function(){
            return null
          },
        },
        markdownOption: {
          bold: true,
        }, 
        message: "",
        errors: "",
      }
    },

    computed: {
      photopath: function() {
        if((typeof this.about.photo !== 'undefined') || this.about.photo !== ''  ){
          return 'storage/' + this.about.photo;
        }
        else{
          return '';
        }
        
      }
    },

    methods: {
      // Implement timeout for messages prompts.
      fetch() {
        axios.get(this.$appurl + '/api/manage/about')
          .then( (response) => {
            this.about = JSON.parse(JSON.stringify( response.data ))
          })
          .catch( (error) => {
            // TODO: Do not show sensitive info.
            this.message = error.message
            this.errors = JSON.parse(JSON.stringify( error.errors ))
          })
      },
      
      updateAbout(){
        let formData = new FormData();
        formData.append('_method', 'patch')
        formData.append('title', this.about.title)
        formData.append('subtitle', this.about.subtitle)
        formData.append('body', this.about.body)
        // TODO: Other formats , fix for file extension
        if(null !== this.photofile){
          formData.append('photofile', this.photofile)
        }
        
        axios.post(this.$appurl + '/api/manage/about/' + this.about.id, 
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            },

          })
          .then( (response) => {
            if(response.data.result === 'ok'){
              // TODO: Do need chaining ?
              this.about.photo = null
              this.about = JSON.parse(JSON.stringify( response.data.about ))
              // this.$emit('update:about', this.about )
              this.message = response.data.message 
              this.errors = "" 
            }
          })
          .catch( (error) => {
            // TODO: Do not show sensitive info.
            this.message = error.message
            this.errors = JSON.parse(JSON.stringify( error.errors ))
          })

      },

      handleFileUpload(){
        this.photofile = this.$refs.file.files[0];
      },

      deletephoto(){
        axios.delete(this.$appurl + '/api/manage/aboutphoto/' + this.about.id)
          .then( response => {
            this.about.photo = ''
            this.photofile = '' 
            this.errors = ''
            this.message = 'Photo deleted.'

          })
          .catch( (error) => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },

    },

    components: {
      Trash2Icon,
    },
  }
</script>

<style scoped>
  .mavonEditor {
    width: 100%;
    height: 100%;
  }
</style>
