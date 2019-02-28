<template>
  <div>
    <form v-on:submit.prevent="deleteItem">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>The following record will be deleted ! Are you sure ? </h4>
      </div>

      <input v-model="test.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Title</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>{{ test.title }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="form-group">
        <button class="btn btn-danger">Yes , Delete ! </button>
      </div>

      <div class="form-group" v-show="message">
        <div class="alert alert-danger">
          {{ message }}
        </div>
      </div>

    </form>

  </div>
</template>

<script>
  export default {
    name: "FormTestDelete",

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
      deleteItem(){
        axios.delete('http://blog.com/api/manage/tests/' + this.test.id)
          .then( (response) => {
            this.$emit('delete:test')
            this.errors = ""
            this.message = ""

          })
          .catch( (error) => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },
      hideform(){
        this.$emit('hide:delete:test')
      },
    },
  }
</script>

<style>
</style>
