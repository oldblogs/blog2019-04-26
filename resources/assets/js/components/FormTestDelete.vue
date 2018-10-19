<template>
  <div>
    <form v-on:submit.prevent="deleteitem(stest)">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>The following record will be deleted ! Are you sure ? </h4>
      </div>

      <input v-model="stest.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Title</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>{{ stest.id }}</td>
                <td>{{ stest.title }}</td>
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
      deleteitem(test){
        axios.delete('http://blog.com/api/manage/tests/' + test.id)
          .then( (response) => {
            this.$emit('delete:test', test.id)
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
