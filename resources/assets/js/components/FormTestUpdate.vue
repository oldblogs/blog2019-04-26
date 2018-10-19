<template>
  <div>
    <form v-on:submit.prevent="updateitem(stest)">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>Update an existing test record </h4>
      </div>

      <input v-model="stest.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <label>Title</label>
        <input v-model="stest.title" type="text" class="form-control" aria-describedby="enter title for test record">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" class="alert alert-danger">
          {{ item }}
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

      <p>{{ stest.id }}</p>

    </form>

  </div>
</template>

<script>
  export default {
    name: "FormTestUpdate",

    mounted() {
      self = this
    },

    props: {
      // type, required and default are optional, you can reduce it to 'options: Object'
      stest: {
        type: Object,
        required: false,

        default: () => {
          return {
            id: 0,
            title: "",
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
      updateitem(test){
        axios.patch('http://blog.com/api/manage/tests/' + test.id, {
            title: test.title,
          })
          .then( (response) => {
            this.$emit('update:test', test.id)
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
