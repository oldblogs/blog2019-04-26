<template>
  <tr>
    <td>{{ post.id }}</td>
    <td>{{ post.user_id }}</td>
    <td>{{ post.title }}</td>
    <td>{{ post.published }}</td>
    <td>{{ post.created_at }}</td>
    <td>{{ post.updated_at }}</td>
    <td><button class="btn btn-sm btn-outline-secondary post-update"
      v-on:click="$emit('show-view-form', post, index)"
      ><book-open-icon class="custom-class"></book-open-icon></button></td>
    <td><button class="btn btn-sm btn-outline-secondary post-update"
      v-on:click="$emit('show-update-form', post, index)"
      ><edit-3-icon class="custom-class"></edit-3-icon></button></td>
    <td><button class="btn btn-sm btn-outline-secondary post-delete"
      v-on:click="$emit('show-delete-form', post, index)"
      ><trash-2-icon></trash-2-icon></button></td>
  </tr>
</template>

<script>
  import { BookOpenIcon, Edit3Icon, Trash2Icon } from 'vue-feather-icons' 

  export default {
    name: "RowPost",

    mounted() {
      feather.replace()
    },

    props: {
      post: {
        type: Object,
        required: true,
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

      index: {
        type: Number,
        required: true,
        default: -1,
      },
    },

    computed: {
    },

    methods: {
    },

    components: {
      BookOpenIcon, Edit3Icon, Trash2Icon,
    }
  }
</script>

<style>
</style>