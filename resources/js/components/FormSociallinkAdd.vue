<template>
  <div>
    <form v-on:submit.prevent="addItem()">
      
      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>      
      </div>
      
      <div class="form-group">
        <h4>Add a new social network link to contact information</h4>
      </div>
      
      <div class="form-group">
        <label>Title</label>
        <input v-model="sociallink.title" type="text" class="form-control" 
          aria-describedby="enter title for social network link">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" 
          class="alert alert-danger">{{ item }}
        </div>
      </div>

      <div class="form-group">
        <label>Social network</label>
        <select v-model="sociallink.csocial_id" class="form-control" 
          aria-describedby="choose your social network">
          <option v-for="socialnetwork in socialnetworks" 
            v-bind:key="socialnetwork.id" v-bind:value="socialnetwork.id" >{{ 
              socialnetwork.title }}</option>
        </select>
      </div>

      <div class="form-group">
        <div v-show="errors.csocial_id" v-for="item in errors.csocial_id" 
          v-bind:key="item" class="alert alert-danger">{{ item }}
        </div>
      </div>

      <div class="form-group">
        <label>Social network link</label>
        <input v-model="sociallink.link" class="form-control" 
          aria-describedby="enter your social network link">
      </div>
      
      <div class="form-group">
        <div v-show="errors.link" v-for="item in errors.link" v-bind:key="item"
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
    name: "FormSociallinkAdd",

    mounted() {

    },
    
    props: {
      sociallink: {
        type: Object,
        required: false,

        default: function(){
          return {
            id: 0,
            title: "",
            csocial_id: 0,
            link: "",
            created_at: "00:00",
            updated_at: "00:00",
            index: -1,
          }
        }
      },

      socialnetworks: {
        type: Array,
        required: false,

        default: [],
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
        axios.post(this.$appurl + '/sociallinks', {
            title: this.sociallink.title,
            csocial_id: this.sociallink.csocial_id,
            link: this.sociallink.link,
          })
          .then( (response) => {
            this.$emit('create:sociallink', JSON.parse( JSON.stringify(response.data) ) )
            this.errors = "" 
            this.message = "" 
          })
          .catch( (error) => {
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