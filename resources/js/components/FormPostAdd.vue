<template>
  <div>
    <form v-on:submit.prevent="addItem">
      
      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>      
      </div>
      
      <div class="form-group">
        <h4>Write a new post</h4>
      </div>
   
      <div class="form-group">
        <label>Title</label>
        <input v-model="post.title" type="text" class="form-control" 
          aria-describedby="enter title for your post">
      </div>

      <div class="form-group">
        <div v-show="errors.title" v-for="item in errors.title" v-bind:key="item" class="alert alert-danger">
          {{ item }}
        </div>
      </div>

      <div class="input-group">
        <label>Body</label>
        <textarea v-model="post.body" class="form-control" aria-label="write your post here"></textarea>
      </div>

      <div class="form-group">
        <div v-show="errors.body" v-for="item in errors.body" v-bind:key="item" class="alert alert-danger">
          {{ item }}
        </div>
      </div>

      <div class="form-check">
        <input v-model="post.published" type="checkbox" class="form-check-input" 
          id="addpublishcheck" aria-describedby="Check to publish the post">
        <label class="form-check-label" for="addpublishcheck">Publish</label>
      </div>

      <div class="form-group">
        <div v-show="errors.published " v-for="item in errors.body" v-bind:key="item" 
          class="alert alert-danger">{{ item }}
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

  export default {
    name: "FormPostAdd",

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
        axios.post('http://blog.com/api/manage/posts', {
            title: this.post.title, 
            body: this.post.body, 
            published: this.post.published, 
          })
          .then( (response) => {
            // TODO: check if this works ( read id value below )
            this.$emit('create:post', JSON.parse(JSON.stringify(response.data) ) )
            this.errors = "" 
            this.message = "" 
          })
          .catch( (error) => {
            this.message = error.response.data.message
            this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
          })
      },
      hideform(){
        this.$emit('hide:add:post')
      }
    },
  }
</script>

<style>
</style>