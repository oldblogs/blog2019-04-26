<template>
  <div>
    <form v-on:submit.prevent="deleteitem(smail)">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>The following record will be deleted ! Are you sure ? </h4>
      </div>

      <input v-model="smail.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Title</th>
                <th>Email</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>{{ smail.id }}</td>
                <td>{{ smail.title }}</td>
                <td>{{ smail.email }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="form-group">
        <button class="btn btn-danger">Yes , Delete !</button>
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
    name: "FormEmailDelete",

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
      deleteitem(email){
        axios.delete('http://blog.com/api/manage/emails/' + email.id)
          .then( (response) => {
            this.$emit('delete:email', email.id)
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
