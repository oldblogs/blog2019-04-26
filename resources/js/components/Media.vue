<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h4 class="h4">Media</h4>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <button class="btn btn-sm btn-outline-secondary"
            v-on:click="showAddForm"><plus-icon class="custom-class"></plus-icon>Add</button>
        </div>
      </div>
    </div>

    <!-- <form-medium-view
      v-show="viewformenabled"
      v-bind:medium="selected"
      v-on:hide-view-medium="hideViewForm"
    ></form-medium-view> -->

    <!-- <form-medium-add
      v-show="addformenabled"
      v-bind:medium="selected"
      v-on:create-medium="addRecord"
      ></form-medium-add> -->
    
    <!-- <form-medium-update
      v-show="updateformenabled"
      v-bind:medium="selected"
      v-bind:mediumtypes="mediumtypes" 
      v-bind:licences="licences" 
      v-on:hide-update-medium="hideUpdateForm"
      v-on:update-medium="updateRecord"
      ></form-medium-update> -->
         
    <!-- <form-medium-delete
      v-show="deleteformenabled"
      v-bind:medium="selected"
      v-on:hide-delete-medium="hideDeleteForm" 
      v-on:delete-medium="deleteRecord"
      ></form-medium-delete> -->
      
   
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <row-medium 
        is="row-medium"
        v-for="(record, index) in records"
        v-bind:medium="record"
        v-bind:index="index"
        v-bind:key="record.id"
        v-on:show-view-form="showViewForm(record, index)"
      ></row-medium>

      <!-- <pagination
        class="mb-0"
        :data="records"
        @pagination-change-page="fetch"
        :limit="vuepagination.limit"
        :show-disabled="vuepagination.showDisabled"
        :size="vuepagination.size"
        :align="vuepagination.align"
      ></pagination> -->
    </div>

  </div>
</template>

<script>
  import RowMedium from './RowMedium.vue' 
  import FormMediumView from './FormMediumView.vue' 
  // import FormMediumAdd from './FormMediumAdd.vue' 
  import FormMediumUpdate from './FormMediumUpdate.vue'
  // import FormMediumDelete from './FormMediumDelete.vue' 

  // import { LaravelVuePagination } from 'laravel-vue-pagination'
  import { PlusIcon } from 'vue-feather-icons'
  
  export default {
    name: 'Media',

    data(){
      return {
        records: {
          type: Array,
          required: false,
          default: function(){
            return []
          },
          // links: {
          //   type: Object,
          //   required: false,
          //   default: function(){
          //     return {
          //       first: '',
          //       last: '',
          //       next: '',
          //       prev: '',
          //     }
          //   } 
          // },

          // meta: {
          //   type: Object,
          //   required: false,
          //   default: function(){
          //     return {
          //       current_page: 1,
          //       from: 1,
          //       last_page: 1,
          //       path: 'media',
          //       per_page: 10,
          //       to: 1,
          //       total: 1,
          //     }
          //   }
          // },
        },

        mediumtypes: {
          type: Array,
          required: false,
          default: function(){
            return []
          }
        },

        licences: {
          type: Array,
          required: false,
          default: function(){
            return []
          }
        },

        viewformenabled: false,
        addformenabled: false,
        updateformenabled: false,
        deleteformenabled: false,

        selected: {
          type: Object,
          required: false,
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

        // vuepagination: {
        //   laravelData: {},
        //   laravelResourceData: {},
        //   limit: 2,
        //   showDisabled: false,
        //   size: 'default',
        //   align: 'left',
        // },

        mediumtypes: {},
        licences: {},

      }
    },

    mounted(){
      this.fetch(1)
      feather.replace()
    },

    methods: {
      fetch(page){
        if (!page){
          page = 1
        }
      
        // TODO: Fix target string
        axios.get(this.$appurl + 'media/' + page)
          .then( (response) => {
            
            this.records = JSON.parse(JSON.stringify( response.data.media))
            this.mediumtypes = JSON.parse(JSON.stringify( response.data.mediumtypes))
            this.licences = JSON.parse(JSON.stringify( response.data.licences)) 
            this.viewformenabled = false 
            this.addformenabled = false
            this.updateformenabled = false
            this.deleteformenabled = false 
            
            // this.vuepagination.laravelData = {
            //  current_page: response.data.media.meta.current_page,
            //   data: response.data.media,
            //   from: response.data.media.meta.from,
            //   last_page: response.data.media.meta.last_page,
            //   next_page_url: response.data.media.links.next,
            //   prev_page_url: response.data.media.links.prev,
            //   per_page: response.data.media.meta.per_page,
            //   to: response.data.media.meta.to,
            //   total: response.data.media.meta.total
            // }
            
          })
      },

      showViewForm(record, index){
        this.selected = JSON.parse(JSON.stringify( record ))
        this.selected.index = index 
        this.viewformenabled = true 
        this.addformenabled = false
        this.updateformenabled =false
        this.deleteformenabled = false 
      },

      hideViewForm(){
        this.viewformenabled = false
        this.selected = {}
      },

      showAddForm(){
        this.selected = {}
        this.viewformenabled = false
        this.addformenabled = true
        this.updateformenabled =false
        this.deleteformenabled =false 
      },

      hideAddForm(){
        this.addformenabled = false 
      },

      showUpdateForm(record, index){
        this.selected = JSON.parse(JSON.stringify( record ))
        this.selected.index = index 
        this.viewformenabled = false 
        this.addformenabled = false
        this.updateformenabled = true 
        this.deleteformenabled = false  
      },

      hideUpdateForm(){
        this.updateformenabled = false
      },

      showDeleteForm(record, index){
        this.selected = JSON.parse(JSON.stringify(record))
        this.selected.index = index
        this.viewformenabled = false
        this.addformenabled = false
        this.updateformenabled = false
        this.deleteformenabled = true
      },

      hideDeleteForm(){
        this.deleteformenabled = false 
      },

      resetSelected(){
        return new Promise((resolve, reject) => {
          this.selected = {}
          resolve()
        })
      },

      addRow(record){
        try {
          this.addformenabled = false 
          return new Promise( (resolve, reject) => {
            this.records.data.push( JSON.parse( JSON.stringify(record) ) )
            // TODO: Check promise implementation . use of resolve
            resolve()
          })
        }
        catch(err) {
          reject(err)
        }
      },

      addRecord(record){
        this.addRow(record).then( this.resetSelected() )
      },

      updateRow(record){
        this.updateformenabled = false
        return new Promise((resolve, reject) => {
          this.records.data.splice( this.selected.index, 1,
            JSON.parse( JSON.stringify(record) ) )
          // TODO: Check promise implementation . use of resolve
          resolve()
        })
      },

      updateRecord(record){
        this.updateRow(record).then( this.resetSelected() )
      },

      removeRow(){
        this.deleteformenabled = false 
        return new Promise((resolve, reject) => {
          this.records.data.splice(this.selected.index, 1)
          resolve()
        })
      },

      deleteRecord(){
        this.removeRow().then( this.resetSelected() )
      },

    },

    computed: {
    },

    watch: {
      // limit (newVal){
      //   this.vuepagination.limit = parseInt(newVal);
      //   if(this.vuepagination.limit < 0){
      //     this.vuepagination.limit = 0
      //   }
      // },
    },

    components: {
      PlusIcon, RowMedium, FormMediumView, FormMediumUpdate 
      //FormMediumAdd, FormMediumDelete, LaravelVuePagination,
    },

  }
</script>

<style>
</style>
