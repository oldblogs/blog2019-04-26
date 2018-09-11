<template>
  <div>
    <form v-on:submit.prevent="create_email">
      
      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>      
      </div>
      
      <div class="form-group">
        <h4>Add a new email to contact information</h4>
      </div>
      
      <div class="form-group">
        <label for="title">Title</label>
        <input v-model="title" type="text" class="form-control" id="title" aria-describedby="enter title for email">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" class="alert alert-danger">
          {{ item }}
        </div>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input v-model="email" id="email" class="form-control" aria-describedby="enter an email">
      </div>
      
      <div class="form-group">
        <div v-show="errors.email" v-for="item in errors.email" v-bind:key="item" class="alert alert-danger">
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
    name: "FormEmailAdd",

    mounted() {
      self = this
      this.formenabled = false
    },
    
    data(){
      return{
        self: {},
        title: "",
        email: "",
        message: "",
        errors: "",

      }
    },

    computed: {

    },

    methods: {
      create_email(){
        axios.post('http://blog.com/api/manage/emails', {
            title: this.title,
            email: this.email,
          })
          .then(response => {
            this.$emit('create:email', this.email.id)
            this.errors = "" 
            this.message = "" 
            this.title = ""
            this.email = "" 
            
            
          })
          .catch(error => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
            // this.errors = Object.assign({}, error.response.data.errors);
          })
      },
      hideform(){
        this.$emit('hide:add:email')
      }
    },
  }
</script>

<style>
</style>