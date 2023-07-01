<template>
  <div v-show="medium">

      <button v-on:click="hideform" type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>

      <div v-if="medium.enabled" class="alert alert-success" role="alert">
        This medium is enabled.
      </div>
      
      <div v-else class="alert alert-secondary" role="alert">
        This medium is disabled.
      </div>

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="form-group">
        <pre>Medium Type: {{ medium.medium_type.mtype }}/{{ medium.medium_type.msubtype }} </pre>
        <pre>License : <a :href="medium.license.lic_deed" rel="external" target="_blank">{{ medium.license.spdx }}</a> ; {{ medium.license.lic_name }} </pre>
        <pre>File : {{ medium.file }} </pre>
        <pre>External Url : {{ medium.external_url }}</pre>
        <pre>Stock Url : <a :href="medium.stock_url">{{ medium.stock_url }}</a></pre>
        <pre>Stock Desc. : {{ medium.stock_desc }}</pre>
        <pre>Created : {{ medium.created_at }}</pre>
        <pre>Updated : {{ medium.updated_at }}</pre>
      </div>

  </div>
</template>

<script>
  export default {
    name: "FormMediumView",

    mounted() {
      
    },

    props: {
      medium: {
        id: Number,
        enabled: Number,
        medium_type_id: Number,
        medium_type: {
          type: Object,
          required: false,
          default: function(){
            return {
              id: 0,
              mtype: '',
              msubtype: '',
              mclass: '',
              created_at: '00:00',
              updated_at: '00:00'
            }
          }
        },
        license_id: 0,
        license: {
          type: Object,
          required: false,
          default: function(){
            return {
              id: 0,
              spdx: '',
              lic_name: '',
              lic_deed: '',
              legal: '',
              fsf: false,
              osi: false,
              created_at: '00:00',
              updated_at: '00:00'
            }
          }
        },
        file: String,
        external_url: String,
        stock_url: String,
        stock_desc: String,
        created_at: String,
        updated_at: String,
        index: Number
      },
    },

    data(){
      return{
        message: '',
        errors: '',
      }
    },

    computed: {

    },

    methods: {
      hideform(){
        this.$emit('hide-view-medium')
      },
    },
  }
</script>

<style>
</style>
