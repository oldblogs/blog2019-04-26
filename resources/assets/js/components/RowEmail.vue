<template>
  <tr>
    <td>{{ email.title }}</td>
    <td>{{ email.email }} </td>
    <td>{{ email.created_at }}</td>
    <td>{{ email.updated_at }}</td>
    <td><button class="btn btn-sm btn-outline-secondary email-update" 
      v-on:click="$emit('show-update-form', email, index)" 
      ><edit-3-icon class="custom-class"></edit-3-icon></button></td>
    <td><button class="btn btn-sm btn-outline-secondary email-delete" 
      v-on:click="$emit('show-delete-form', email, index)" 
      ><trash-2-icon class="custom-class"></trash-2-icon></button></td>
  </tr>
</template>

<script>
  import { BookOpenIcon, Edit3Icon, Trash2Icon  } from 'vue-feather-icons'

  export default {
    name: "RowSociallink",

    mounted() {
      feather.replace()
    },

    props: {
      email: {
        type: Object,
        required: true,

        default: () => {
          return {
            id: 0,
            title: "",
            email: "",
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
