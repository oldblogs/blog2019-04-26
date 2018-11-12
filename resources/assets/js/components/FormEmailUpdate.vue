<template>
  <div>
    <form v-on:submit.prevent="updateitem(smail)">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>Update an existing email </h4>
      </div>

      <input v-model="smail.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <label>Title</label>
        <input v-model="smail.title" type="text" class="form-control" aria-describedby="enter title for email">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" class="alert alert-danger">
          {{ item }}
        </div>
      </div>

      <div class="form-group">
        <label>Email</label>
        <input v-model="smail.email" class="form-control" aria-describedby="enter an email">
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

      <p>Email ID: {{ smail.id }}</p>

    </form>

  </div>
</template>

<script>
  export default {
    name: "FormEmailUpdate",

    mounted() {
      self = this
    },

    props: {
      // type, required and default are optional, you can reduce it to 'options: Object'
      smail: {
        type: Object,
        required: false,

        default: () => {
          return {
            id: 0,
            title: "",
            email: "",
          }
        },
      },
    },

    data(){
      return{
        self: {},
        message: "",
        errors: "",

      }
    },

    computed: {

    },

    methods: {
      updateitem(email){
        axios.patch('http://blog.com/api/manage/emails/' + email.id, {
            title: email.title,
            email: email.email,
          })
          .then( response => {
            this.$emit('update:email', email.id)
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
