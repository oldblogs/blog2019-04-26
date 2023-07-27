<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h4 class="h4">Emails</h4>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <button class="btn btn-sm btn-outline-secondary email-add" 
            v-on:click="showAddForm"><plus-icon class="custom-class"></plus-icon>Add</button>
        </div>
      </div>
    </div>
    <form-email-add 
      v-show="addformenabled" 
      v-bind:email="selected"
      v-on:hide:add:email="hideAddForm" 
      v-on:create:email="addItem" 
      ></form-email-add>

    <form-email-update
      v-show="updateformenabled"
      v-bind:email="selected"
      v-on:hide:update:email="hideUpdateForm"
      v-on:update:email="updateItem"
      ></form-email-update>

    <form-email-delete
      v-show="deleteformenabled"
      v-bind:email="selected"
      v-on:hide:delete:email="hideDeleteForm"
      v-on:delete:email="deleteItem"
      ></form-email-delete>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>Title</th>
            <th>Email</th>
            <th>Created</th>
            <th>Modified</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>

        <tbody >
          <row-email
            is="row-email"
            v-for="(email, index) in contact_emails"
            v-bind:email="email"
            v-bind:index="index"
            v-bind:key="email.id"
            v-on:show-update-form="showUpdateForm(email, index)"
            v-on:show-delete-form="showDeleteForm(email, index)"
          ></row-email>
        </tbody>

      </table>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3"></div>
  </div>
</template>

<script>

  import FormEmailAdd from './FormEmailAdd.vue'
  import FormEmailUpdate from './FormEmailUpdate.vue'
  import FormEmailDelete from './FormEmailDelete.vue'

  import { PlusIcon } from 'vue-feather-icons'

  export default {
    name: "Emails",

    mounted() {
      this.fetch()
      feather.replace()
    },

    data(){
      return{
        contact_emails: [],
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
              email: "",
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
        axios.get(this.$appurl + 'emails')
          .then((response) => {
            this.contact_emails = JSON.parse(JSON.stringify( response.data.data ))
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

      showUpdateForm(email, index){
        this.selected = JSON.parse(JSON.stringify( email ))
        this.selected.index = index
        this.addformenabled = false
        this.updateformenabled = true
        this.deleteformenabled = false
      },

      hideUpdateForm(){
        this.updateformenabled = false
      },

      showDeleteForm(email, index){
        this.selected = JSON.parse(JSON.stringify( email ))
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

      addItem(email){
        this.contact_emails.push( JSON.parse( JSON.stringify(email) ) )
        this.addformenabled = false 
        this.selected = {}
      },

      updateRow(email){
        this.updateformenabled = false
        return new Promise((resolve, reject) => {
          this.contact_emails.splice( this.selected.index, 1,
            JSON.parse( JSON.stringify(email) ) )
          resolve() 
        })
      },

      updateItem(email){
        this.updateRow(email).then( this.resetSelected() )
      },

      removeRow(){
        this.deleteformenabled = false 
        return new Promise((resolve, reject) => {
          this.contact_emails.splice(this.selected.index, 1)
          resolve()
        })
      },

      deleteItem(){
        this.removeRow().then( this.resetSelected() )
      },

    },
    components: {
      FormEmailAdd, FormEmailUpdate, FormEmailDelete, PlusIcon,
    },
  }
</script>

<style>
</style>
