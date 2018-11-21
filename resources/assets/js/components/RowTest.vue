<template>
  <tr>
    <td>{{ test.id }}</td>
    <td>{{ test.title }}</td>
    <td>{{ test.created_at }}</td>
    <td>{{ test.updated_at }}</td>
    <td><button class="btn btn-sm btn-outline-secondary test-update"
      v-on:click="$emit('show-update-form', test, index)"
      ><edit-3-icon class="custom-class"></edit-3-icon></button></td>
    <td><button class="btn btn-sm btn-outline-secondary test-delete"
      v-on:click="$emit('show-delete-form', test, index)"
      ><trash-2-icon></trash-2-icon></button></td>
  </tr>
</template>

<script>
  import { BookOpenIcon, Edit3Icon, Trash2Icon } from 'vue-feather-icons' 

  export default {
    name: "RowTest",

    mounted() {
      feather.replace()
    },

    props: {
      test: {
        type: Object,
        required: true,

        default: () => {
          return {
            id: 0,
            title: "",
            created_at: "00:00",
            updated_at: "00:00",
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