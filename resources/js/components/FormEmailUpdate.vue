<template>
  <div>
    <form v-on:submit.prevent="updateitem()">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>Update an existing email </h4>
      </div>

      <input v-model="email.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <label>Title</label>
        <input v-model="email.title" type="text" class="form-control" 
          aria-describedby="enter title for email">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" 
          class="alert alert-danger">{{ item }}
        </div>
      </div>

      <div class="form-group">
        <label>Email</label>
        <input v-model="email.email" class="form-control" aria-describedby="enter an email">
      </div>

      <div class="form-group">
        <div v-show="errors.email" v-for="item in errors.email" v-bind:key="item" 
          class="alert alert-danger">{{ item }}
        </div>
      </div>

      <div class="form-group">
        <button class="btn btn-primary">Save</button>
      </div>

      <div class="form-group" v-show="message">
        <div class="alert alert-danger">
          {{ message }}
        </div>
      </div>

      <p>Email ID: {{ email.id }}</p>

    </form>

  </div>
</template>

<script>
  export default {
    name: "FormEmailUpdate",

    mounted() {

    },

    props: {
      email: {
        type: Object,
        required: false,

        default: function(){
          return {
            id: 0,
            title: "",
            email: "",
            created_at: "00:00",
            updated_at: "00:00",
            index: -1,
          }
        },
      },
    },

    data(){
      return{
        message: "",
        errors: "",

      }
    },

    computed: {

    },

    methods: {
      updateitem(){
        // TODO: change manage text with related config variable
        axios.patch(this.$appurl + '/api/manage/emails/' + this.email.id, {
            title: this.email.title,
            email: this.email.email,
          })
          .then( response => {
            this.$emit('update:email', JSON.parse( JSON.stringify( response.data ) ) )
            this.errors = ""
            this.message = ""

          })
          .catch( (error) => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },
      hideform(){
        this.$emit('hide:update:email')
      },
    },
  }
</script>

<style>
</style>
