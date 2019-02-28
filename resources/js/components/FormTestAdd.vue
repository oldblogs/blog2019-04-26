<template>
  <div>
    <form v-on:submit.prevent="addItem">
      
      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>      
      </div>
      
      <div class="form-group">
        <h4>Add a new test record</h4>
      </div>
   
      <div class="form-group">
        <label>Title</label>
        <input v-model="test.title" type="text" class="form-control" 
          aria-describedby="enter title for test record">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" class="alert alert-danger">
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

  // TODO: Check v-bind:key syntax above

  export default {
    name: "FormTestAdd",

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
        axios.post('http://blog.com/api/manage/tests', {
            title: this.test.title,
          })
          .then( (response) => {
            // TODO: check if this works ( read id value below )
            this.$emit('create:test', JSON.parse(JSON.stringify(response.data) ) )
            this.errors = "" 
            this.message = "" 
          })
          .catch( (error) => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },
      hideform(){
        this.$emit('hide:add:test')
      }
    },
  }
</script>

<style>
</style>