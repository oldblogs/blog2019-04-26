<template>
  <div>
    <form v-on:submit.prevent="addItem()">
      
      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>      
      </div>
      
      <div class="form-group">
        <h4>Add a new email to contact information</h4>
      </div>

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

    },
    
    // TODO: Check property & data naming collitions
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
        }
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
      addItem(){
        axios.post(this.$appurl + '/api/manage/emails', {
            title: this.email.title,
            email: this.email.email,
          })
          .then(response => {
            this.$emit('create:email', JSON.parse( JSON.stringify(response.data) ) )
            this.errors = "" 
            this.message = "" 
            
          })
          .catch(error => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
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