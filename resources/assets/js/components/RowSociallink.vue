<template>
  <tr>
    <td>{{ sociallink.title }}</td>
    <td>{{ sociallink.csocial_id }}</td>
    <td>{{ sociallink.link }} </td>
    <td>{{ sociallink.created_at }}</td>
    <td>{{ sociallink.updated_at }}</td>
    <td><button class="btn btn-sm btn-outline-secondary sociallink-update"
      v-on:click="$emit('show-update-form', sociallink, index)"
      ><edit-3-icon class="custom-class"></edit-3-icon></button></td>
    <td><button class="btn btn-sm btn-outline-secondary sociallink-delete"
      v-on:click="$emit('show-delete-form', sociallink, index)"
      ><trash-2-icon></trash-2-icon></button></td>
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
      sociallink: {
        type: Object,
        required: true,

        default: () => {
          return {
            id: 0,
            title: "",
            csocial_id: 0,
            link: "",
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
