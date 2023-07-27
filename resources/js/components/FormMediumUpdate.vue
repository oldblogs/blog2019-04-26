<template>
  <div>
    <form v-on:submit.prevent="medium.updateItem">

      <div class="form-group">
        <button v-on:click="medium.hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>Update an existing medium record </h4>
      </div>

      <input v-model="medium.id" type="text" class="form-control" style="display: none" >

      <div class="form-check">
        <input v-model="medium.enabled" type="checkbox" class="form-check-input" 
          id="enablecheck" aria-describedby="Check to enable the medium">
        <label class="form-check-label" for="enablecheck">Enable</label>
      </div>

      <div class="form-group">
        <div v-show="errors.enabled " v-for="item in errors.enabled" v-bind:key="item" 
          class="alert alert-danger">{{ item }}
        </div>
      </div>

      <div class="form-group">
        <label>Description</label>
        <input v-model="medium.description" type="text" class="form-control" 
          aria-describedby="Enter title for the medium">
      </div>

      <div class="form-group">
        <div v-show="errors.description" v-for="item in errors.description" v-bind:key="item" 
          class="alert alert-danger">{{ item }}
        </div>
      </div>

      <div class="form-group">
        <label for="medium_type_id">Medium Type</label>
        <select v-model="medium.medium_type_id" id="medium_type_id" class="form-control" 
          aria-describedby="Choose your media type">
          <option v-for="medium_type in medium.medium_types" 
            v-bind:key="medium_type.id" v-bind:value="medium_type.id" >{{ 
              medium_type.mtype }} / {{ medium_type.msubtype }}</option>
        </select>
      </div>

      <div class="form-group">
        <div v-show="errors.medium_type_id" v-for="item in errors.medium_type_id" 
          v-bind:key="item" class="alert alert-danger">{{ item }}
        </div>
      </div>

      <div class="form-group">
        <label for="license_id">License</label>
        <select v-model="medium.license_id" id="license_id" class="form-control" 
          aria-describedby="Choose license for the media">
          <option v-for="license in medium.licences" 
            v-bind:key="license.id" v-bind:value="license.id" >{{ 
              license.spdx }} </option>
        </select>
      </div>

      <div class="form-group">
        <div v-show="errors.license_id" v-for="item in errors.license_id" 
          v-bind:key="item" class="alert alert-danger">{{ item }}
        </div>
      </div>

      <div class="form-group">
        <label>File</label>
        <input v-model="medium.file" type="text" class="form-control" 
          aria-describedby="Upload a file">
      </div>


      <div class="form-group">
        <label>File</label>
        <div>
          <button class="btn btn-sm btn-outline-secondary" 
            v-if="medium.file" v-on:click="medium.deletemedium" ><trash-2-icon class="custom-class"></trash-2-icon></button>
          <input type="file" id="file" ref="file" class="form-control-file" aria-describedby="Choose a file" v-on:change="handleFileUpload"/>
        </div>
      </div>

      <div class="form-group">
        <div v-show="errors.file" v-for="item in errors.file" v-bind:key="item" 
          class="alert alert-danger">{{ item }}
        </div>
      </div>
    </form>

  </div>
</template>

<script>
  import MediumDisplay from './MediumDisplay.vue' 
  import { Trash2Icon } from 'vue-feather-icons'

  export default {
    name: "FormMediumUpdate",

    mounted() {
      this.fetch()
    },

    data(){
      return{
        medium: {
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
        mediumfile: {
          type: Object,
          required: false,
          default: function(){
            return null
          },
        },
        message: "",
        errors: "",
      }
    },

    computed: {
      mediumpath: function() {
        if((typeof this.file !== 'undefined') || this.file !== ''  ){
          return 'storage/' + this.file;
        }
        else{
          return '';
        }
        
      }
    },
    
    methods: {
      // Implement timeout for messages prompts.
      fetch() {
        axios.get(this.$appurl + 'media/' + media.id)
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
        
        axios.post(this.$appurl + 'about/' + this.about.id, 
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
        this.mediumfile = this.$refs.file.files[0];
      },

      deletephoto(){
        axios.delete(this.$appurl + 'aboutphoto/' + this.about.id)
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

      hideform(){
        this.$emit('hide:update:medium')
      },

    },

    components: {
      MediumDisplay, Trash2Icon,
    },
  }
</script>

<style>
</style>