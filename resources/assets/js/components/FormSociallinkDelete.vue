<template>
  <div>
    <form v-on:submit.prevent="deleteitem()">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>The following record will be deleted ! Are you sure ? </h4>
      </div>

      <input v-model="sociallink.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Title</th>
                <th>SocialN</th>
                <th>Link</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>{{ sociallink.title }}</td>
                <td>{{ sociallink.csocial_id }}</td>
                <td>{{ sociallink.link }}</td>
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
    name: "FormSociallinkDelete",

    mounted() {

    },

    props: {
      sociallink: {
        type: Object,
        required: false,

        default: () => {
          return {
            id: 0,
            title: "",
            csocial_id: 0,
            link: "",
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
      deleteitem(){
        axios.delete('http://blog.com/api/manage/sociallinks/' + this.sociallink.id)
          .then( (response) => {
            this.$emit('delete:sociallink')
            this.errors = ""
            this.message = ""
          })
          .catch( (error) => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },
      hideform(){
        this.$emit('hide:delete:sociallink')
      },
    },
  }
</script>

<style>
</style>
