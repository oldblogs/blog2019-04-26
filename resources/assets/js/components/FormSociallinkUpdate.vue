<template>
  <div>
    <form v-on:submit.prevent="updatesociallink(ssociallink)">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>Update an existing social link </h4>
      </div>

      <input v-model="ssociallink.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <label>Social Network</label>
        <input v-model="ssociallink.csocial_id" type="text" class="form-control" aria-describedby="choose social network">
      </div>

      <div class="form-group">
        <div v-show="errors.csocial_id" v-for="item in errors.csocial_id" v-bind:key="item" class="alert alert-danger">
          {{ item }}
        </div>
      </div>

      <div class="form-group">
        <label>Title</label>
        <input v-model="ssociallink.title" type="text" class="form-control" aria-describedby="enter title for social link">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" class="alert alert-danger">
          {{ item }}
        </div>
      </div>

      <div class="form-group">
        <label>Social Network Link</label>
        <input v-model="ssociallink.link" class="form-control" aria-describedby="enter a social network link">
      </div>

      <div class="form-group">
        <div v-show="errors.sociallink" v-for="item in errors.sociallink" v-bind:key="item" class="alert alert-danger">
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

      <p>{{ ssociallink.id }}</p>

    </form>

  </div>
</template>

<script>
  export default {
    name: "FormSociallinkUpdate",

    mounted() {
      self = this
    },

    props: {
      // type, required and default are optional, you can reduce it to 'options: Object'
      ssociallink: {
        type: Object,
        required: false,

        default: () => {
          return {
            id: 0,
            csocial_id: 0,
            title: "",
            link: "",
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
      updatesociallink(sociallink){
        axios.patch('http://blog.com/api/manage/sociallinks/' + sociallink.id, {
            csocial_id: sociallink.csocial_id,
            title: sociallink.title,
            link: sociallink.link,
          })
          .then( (response) => {
            this.$emit('update:sociallink', sociallink.id)
            this.errors = ""
            this.message = ""

          })
          .catch( (error) => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },
      hideform(){
        this.$emit('hide:update:sociallink')
      },
    },
  }
</script>

<style>
</style>
