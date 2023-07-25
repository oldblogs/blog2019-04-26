<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h4 class="h4">Test List</h4>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <button class="btn btn-sm btn-outline-secondary" 
            v-on:click="showAddForm"><plus-icon class="custom-class"></plus-icon>Add</button>
        </div>
      </div>
    </div>

    <form-test-add 
      v-show="addformenabled" 
      v-bind:test="selected"
      v-on:hide:add:test="hideAddForm" 
      v-on:create:test="addRecord" 
      ></form-test-add>

    <form-test-update
      v-show="updateformenabled"
      v-bind:test="selected"
      v-on:hide:update:test="hideUpdateForm"
      v-on:update:test="updateRecord"
      ></form-test-update>

    <form-test-delete
      v-show="deleteformenabled"
      v-bind:test="selected"
      v-on:hide:delete:test="hideDeleteForm"
      v-on:delete:test="deleteRecord"
      ></form-test-delete>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Title</th>
            <th>Created</th>
            <th>Modified</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>

        <tbody>
          <row-test
            is="row-test"
            v-for="(record, index) in records"
            v-bind:test="record"
            v-bind:index="index"
            v-bind:key="record.id"
            v-on:show-update-form="showUpdateForm(record, index)"
            v-on:show-delete-form="showDeleteForm(record, index)"
          ></row-test>
        </tbody>

      </table>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3"></div>
  </div>
</template>

<script>

  import FormTestAdd from './FormTestAdd.vue'
  import FormTestUpdate from './FormTestUpdate.vue'
  import FormTestDelete from './FormTestDelete.vue'

  import { PlusIcon } from 'vue-feather-icons'

  export default {
    name: "Tests",

    mounted() {
      this.fetch()
      feather.replace()
    },

    data(){
      return{
        records: [],
        addformenabled: false,
        updateformenabled: false,
        deleteformenabled: false,

        selected: {
          type: Object,
          required: false,
          default: function(){
            return {
              id: 0,
              title: "",
              created_at: "00:00",
              updated_at: "00:00",
              index: -1,
            }
          },
        },
      }
    },

    computed: {

    },

    methods: {
      fetch() {
        // TODO: Fix target string
        axios.get(this.$appurl + '/api/manage/tests')
          .then( (response) => {
            this.records = JSON.parse(JSON.stringify( response.data.tests ))
            this.addformenabled = false
            this.updateformenabled = false
            this.deleteformenabled = false
          })
      },
      
      showAddForm(){
        // this.selected = {}
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

      addRecord(record){
        this.records.push( JSON.parse( JSON.stringify(record) ) )
        this.addformenabled = false 
        this.selected = {}
      },

      updateRow(record){
        this.updateformenabled = false
        return new Promise((resolve, reject) => {
          this.records.splice( this.selected.index, 1,
            JSON.parse( JSON.stringify(record) ) )
            .then( resolve() )
        })
      },

      updateRecord(record){
        this.updateRow(record).then( this.resetSelected() )
      },

      removeRow(){
        this.deleteformenabled = false 
        return new Promise((resolve, reject) => {
          this.records.splice(this.selected.index, 1)
          resolve()
        })
      },

      deleteRecord(){
        this.removeRow().then( this.resetSelected() )
      },

    },

    components: {
      FormTestAdd, FormTestUpdate, FormTestDelete, PlusIcon,
    },
  }
</script>

<style>
</style>
