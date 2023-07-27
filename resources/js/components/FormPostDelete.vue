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

      <input v-model="post.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Title</th>
                <th>Published</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>{{ post.id }}</td>
                <td>{{ post.user_id }}</td>
                <td>{{ post.title }}</td>
                <td>{{ post.published }}</td>
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
    name: "FormPostDelete",

    mounted() {

    },

    props: {
      post: {
        type: Object,
        required: false,

        default: function(){
          return {
            id: 0,
            user_id: 0,
            title: "",
            body: "",
            published: false,
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
      deleteItem(){
        axios.delete(this.$appurl + 'posts/' + this.post.id)
          .then( (response) => {
            this.$emit('delete:post')
            this.errors = ""
            this.message = ""

          })
          .catch( (error) => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },
      hideform(){
        this.$emit('hide:delete:post')
      },
    },
  }
</script>

<style>
</style>
