<template>
  <div>
    <form v-on:submit.prevent="updateItem">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>Update an existing test record </h4>
      </div>

      <input v-model="test.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <label>Title</label>
        <input v-model="test.title" type="text" class="form-control" 
          aria-describedby="enter title for test record">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" 
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

      <p>{{ test.id }}</p>

    </form>

  </div>
</template>

<script>
  export default {
    name: "FormTestUpdate",

    mounted() {
      
    },

    props: {
      test: {
        type: Object,
        required: false,

        default: function(){
          return {
            id: 0,
            title: "",
            created_at: "00:00",
            created_at: "00:00",
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
      updateItem(){
        axios.patch(this.$appurl + '/api/manage/tests/' + this.test.id, {
            title: this.test.title,
          })
          .then( (response) => {
            this.$emit('update:test', JSON.parse( JSON.stringify( response.data ) ) )
            this.errors = ""
            this.message = ""

          })
          .catch( (error) => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },
      
      hideform(){
        this.$emit('hide:update:test')
      },
    },
  }
</script>

<style>
</style>
