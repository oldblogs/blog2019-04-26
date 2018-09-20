<template>
  <div>
    <form v-on:submit.prevent="create_sociallink">
      
      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>      
      </div>
      
      <div class="form-group">
        <h4>Add a new social network link to contact information</h4>
      </div>
      
      <div class="form-group">
        <label for="title">Title</label>
        <input v-model="title" type="text" class="form-control" id="title" aria-describedby="enter title for social network link">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" class="alert alert-danger">
          {{ item }}
        </div>
      </div>

      <div class="form-group">
        <label for="csocial_id">Social network</label>
        <input v-model="csocial_id" id="csocial_id" class="form-control" aria-describedby="choose your social network">
      </div>
      
      <div class="form-group">
        <div v-show="errors.csocial_id" v-for="item in errors.csocial_id" v-bind:key="item" class="alert alert-danger">
          {{ item }}
        </div>
      </div>

      <div class="form-group">
        <label for="link">Social network link</label>
        <input v-model="link" id="link" class="form-control" aria-describedby="enter your social network link">
      </div>
      
      <div class="form-group">
        <div v-show="errors.link" v-for="item in errors.link" v-bind:key="item" class="alert alert-danger">
          {{ item }}
        </div>
      </div>
      
      <div class="form-group">
        <button class="btn btn-primary">Save</button>
      </div>
      
      <div class="form-group" v-show="message"   >
        <div class="alert alert-danger">
          {{ message }}
        </div>
      </div>

    </form>

  </div>
</template>

<script>

  export default {
    name: "FormSociallinkAdd",

    mounted() {
      self = this
      this.formenabled = false
    },
    
    data(){
      return{
        self: {},
        title: "",
        csocial_id: 0,
        link: "",
        message: "",
        errors: "",

      }
    },

    computed: {

    },

    methods: {
      create_sociallink(){
        axios.post('http://blog.com/api/manage/sociallinks', {
            title: this.title,
            csocial_id: this.csocial_id,
            link: this.link,
          })
          .then(response => {
            this.$emit('create:sociallink', this.sociallink.id)
            this.errors = "" 
            this.message = "" 
            this.title = ""
            this.csocial_id = 0
            this.link = "" 
        
          })
          .catch(error => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },
      hideform(){
        this.$emit('hide:add:sociallink')
      }
    },
  }
</script>

<style>
</style>