<template>
  <div>
      <div v-if="post.published" class="alert alert-success" role="alert">
        This post is published.
      </div>
      
      <div v-else class="alert alert-secondary" role="alert">
        This post is not published.
      </div>
      
      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="blog-post">
        <h2 class="blog-post-title">{{ post.title }}</h2>
        <p class="blog-post-meta">{{ post.created_at }}</p>

        <div class="mavonEditor">
          <no-ssr>
            <mavon-editor defaultOpen="preview" v-model="post.body" :toolbarsFlag="false" :subfield="false"></mavon-editor>
          </no-ssr>
        </div>
      </div>

      <pre>Post ID: {{ post.id }} </pre>
      <pre>User ID: {{ post.user_id }} </pre>
  </div>
</template>

<script>
  export default {
    name: "FormPostView",

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
            title: '',
            body: '',
            published: false,
            created_at: '00:00',
            updated_at: '00:00',
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
      }
    },

    computed: {

    },

    methods: {
      hideform(){
        this.$emit('hide:view:post')
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
