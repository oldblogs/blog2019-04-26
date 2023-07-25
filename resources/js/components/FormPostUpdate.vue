<template>
  <div>
    <form v-on:submit.prevent="updateItem">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <h4>Update an existing post record </h4>
      </div>

      <input v-model="post.id" type="text" class="form-control" style="display: none" >

      <div class="form-group">
        <label>User ID: {{ post.user_id }}</label>
      </div>

      <div class="form-group">
        <label>Title</label>
        <input v-model="post.title" type="text" class="form-control" 
          aria-describedby="enter title for the post">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" 
          class="alert alert-danger">{{ item }}
        </div>
      </div>

      <div class="form-group">
        <label>Content</label>
        <div class="mavonEditor">
          <no-ssr>
            <mavon-editor :toolbars="markdownOption" v-model="post.body" aria-label="write your post here"></mavon-editor>
          </no-ssr>
        </div>
      </div>

      <div class="form-group">
        <div v-show="errors.body" v-for="item in errors.body" v-bind:key="item" 
          class="alert alert-danger">{{ item }}
        </div>
      </div>

      <div class="form-check">
        <input v-model="post.published" type="checkbox" class="form-check-input" 
          id="updpublishcheck" aria-describedby="Check to publish the post">
        <label class="form-check-label" for="updpublishcheck">Publish</label>
      </div>

      <div class="form-group">
        <div v-show="errors.published " v-for="item in errors.body" v-bind:key="item" 
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

      <p>{{ post.id }}</p>

    </form>

  </div>
</template>

<script>
  export default {
    name: "FormPostUpdate",

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
        markdownOption: {
          bold: true,
        },
        message: "",
        errors: ""
      };
    },

    computed: {

    },

    methods: {
      updateItem(){
        axios.patch(this.$appurl + '/api/manage/posts/' + this.post.id, {
            title: this.post.title, 
            body: this.post.body, 
            published: Boolean(this.post.published), 
          })
          .then( (response) => {
            this.$emit('update:post', JSON.parse( JSON.stringify( response.data ) ) )
            this.errors = ""
            this.message = ""

          })
          .catch( (error) => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },
      
      hideform(){
        this.$emit('hide:update:post')
      },
    },
  }
</script>

<style scoped>
  .mavonEditor {
    width: 100%;
    height: 100%;
  }
</style>
