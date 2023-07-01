<template>
  <div class="card" style="width: 18rem;">

    <medium-display v-bind:medium="medium"></medium-display>

    <div class="card-body">
      <p class="card-text">{{ medium.description }}
        <span v-if="medium.enabled" class="badge badge-success">Enabled</span>
        <span v-else class="badge badge-secondary">Disabled</span>
      </p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Type: {{ medium.medium_type.mtype }}/{{ medium.medium_type.msubtype }}</li>
      <li class="list-group-item">License: <a :href="medium.license.lic_deed" rel="external" target="_blank">{{ medium.license.spdx }}</a></li>
    </ul>
    <div class="card-footer">
      <button class="btn btn-sm btn-outline-secondary medium-update"
      v-on:click="$emit('show-view-form', medium, index)"
      ><book-open-icon class="custom-class"></book-open-icon></button>
      <button class="btn btn-sm btn-outline-secondary medium-update"
      v-on:click="$emit('show-update-form', medium, index)"
      ><edit-3-icon class="custom-class"></edit-3-icon></button>
      <button class="btn btn-sm btn-outline-secondary medium-delete"
      v-on:click="$emit('show-delete-form', medium, index)"
      ><trash-2-icon></trash-2-icon></button>
    </div>
  </div>
</template>

<script>
  import { BookOpenIcon, Edit3Icon, Trash2Icon } from 'vue-feather-icons' 
  import MediumDisplay from './MediumDisplay.vue' 

  export default {
    name: "RowMedium",

    mounted() {
      feather.replace()
    },

    props: {
      medium: {
        type: Object,
        required: true,
        default: function(){
          return {
            id: 0,
            enabled: false,
            medium_type_id: 0,
            medium_type: {
              id: 0,
              mtype: '',
              msubtype: '',
              mclass: '',
              created_at: '00:00',
              updated_at: '00:00'
            },
            license_id: 0,
            license: {
              id: 0,
              spdx: '',
              lic_name: '',
              lic_deed: '',
              legal: '',
              fsf: false,
              osi: false,
              created_at: '00:00',
              updated_at: '00:00'
            },
            file: '',
            external_url: '',
            stock_url: '',
            stock_desc: '',
            created_at: '00:00',
            updated_at: '00:00',
            index: -1
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
      BookOpenIcon, Edit3Icon, Trash2Icon, MediumDisplay, 
    }
  }
</script>

<style>
</style>