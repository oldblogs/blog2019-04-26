<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h4 class="h4">Posts</h4>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <button class="btn btn-sm btn-outline-secondary" 
            v-on:click="showAddForm"><plus-icon class="custom-class"></plus-icon>Add</button>
        </div>
      </div>
    </div>

    <form-post-view 
      v-show="viewformenabled" 
      v-bind:post="selected"
      v-on:hide:view:post="hideViewForm" 
      v-on:view:post="viewRecord" 
      ></form-post-view>

    <form-post-add 
      v-show="addformenabled" 
      v-bind:post="selected"
      v-on:hide:add:post="hideAddForm" 
      v-on:create:post="addRecord" 
      ></form-post-add>

    <form-post-update
      v-show="updateformenabled"
      v-bind:post="selected"
      v-on:hide:update:post="hideUpdateForm"
      v-on:update:post="updateRecord"
      ></form-post-update>

    <form-post-delete
      v-show="deleteformenabled"
      v-bind:post="selected"
      v-on:hide:delete:post="hideDeleteForm"
      v-on:delete:post="deleteRecord"
      ></form-post-delete>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#ID</th>
            <th>User ID</th>
            <th>Title</th>
            <th>Published</th>
            <th>Created</th>
            <th>Modified</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>

        <tbody>
          <row-post
            is="row-post"
            v-for="(record, index) in records.data"
            v-bind:post="record"
            v-bind:index="index"
            v-bind:key="record.id"
            v-on:show-view-form="showViewForm(record, index)"
            v-on:show-update-form="showUpdateForm(record, index)"
            v-on:show-delete-form="showDeleteForm(record, index)"
          ></row-post>
        </tbody>
        <tfoot>
          <pagination
            class="mb-0"
            :data="records"
            @pagination-change-page="fetch"
            :limit="vuepagination.limit"
            :show-disabled="vuepagination.showDisabled"
            :size="vuepagination.size"
            :align="vuepagination.align" 
          ></pagination>
          
        </tfoot>
      </table>
    </div>
  </div>
</template>

<script>
  // TODO: Check vue component event names
  import FormPostView from './FormPostView.vue'
  import FormPostAdd from './FormPostAdd.vue'
  import FormPostUpdate from './FormPostUpdate.vue'
  import FormPostDelete from './FormPostDelete.vue'
  
  import { LaravelVuePagination } from 'laravel-vue-pagination'
  import { PlusIcon } from 'vue-feather-icons'

  export default {
    name: 'Posts',

    data(){
      return{
        records: {
          data: [],

          links: {
            type: Object,
            required: false,
            default: function(){
              return {
                first: '',
                last: '',
                next: '',
                prev: '',
              }
            }
          },
 
          meta: {
            type: Object,
            required: false,
            default: function(){
              return {
                current_page: 1,
                from: 1,
                last_page: 1,
                path: 'posts',
                per_page: 10,
                to: 1,
                total: 1,
              }
            }
          },

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
              user_id: 0,
              title: "",
              body: "",
              published: false,
              created_at: "00:00",
              updated_at: "00:00",
              index: '',
            }
          },
        },

        vuepagination: {
          laravelData: {},
          laravelResourceData: {},
          limit: 2,
          showDisabled: false,
          size: 'default',
          align: 'left',

        },

      }
    },

    mounted() {
      this.fetch(1)
      feather.replace()
    },

    methods: {
      fetch(page) {
        if (!page) {
            page = 1
        }
        
        // TODO: Fix target string
        axios.get('http://blog.com/api/manage/posts/' + page)
          .then( (response) => {
            this.records = JSON.parse(JSON.stringify( response.data ))
            this.viewformenabled = false
            this.addformenabled = false
            this.updateformenabled = false
            this.deleteformenabled = false

            this.vuepagination.laravelData = {
              current_page: response.data.meta.current_page,
              data: this.records,
              from: response.data.meta.from,
              last_page: response.data.meta.last_page,
              next_page_url: response.data.links.next,
              per_page: response.data.meta.per_page,
              prev_page_url:  response.data.links.prev,
              to: response.data.meta.to,
              total: response.data.meta.total
            }
          })
      },
      
      showViewForm(record, index){
        this.selected = JSON.parse(JSON.stringify( record ))
        this.selected.index = index
        this.viewformenabled = true
        this.addformenabled = false
        this.updateformenabled = false
        this.deleteformenabled = false
      },

      hideViewForm(){
        this.viewformenabled = false
      },

      showAddForm(){
        // this.selected = {}
        this.viewformenabled = false
        this.addformenabled = true
        this.updateformenabled = false
        this.deleteformenabled = false
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
        this.selected = JSON.parse(JSON.stringify( record ))
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

      viewRecord(record){
        this.viewformenabled = false
        this.selected = {}
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
          // TODO: Check promise implementation . use of resolve
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
      limit (newVal) {
        this.vuepagination.limit = parseInt(newVal);
        if(this.vuepagination.limit < 0){
          this.vuepagination.limit = 0
        }
      }
    },

    components: {
      FormPostView, FormPostAdd, FormPostUpdate, FormPostDelete, PlusIcon, LaravelVuePagination,
    },
  }
</script>

<style>
</style>
