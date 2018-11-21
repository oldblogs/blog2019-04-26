<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h4 class="h4">Social Links</h4>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <button class="btn btn-sm btn-outline-secondary sociallink-add" 
            v-on:click="showAddForm"><plus-icon class="custom-class"></plus-icon>Add</button>
        </div>
      </div>
    </div>

    <form-sociallink-add 
      v-show="addformenabled" 
      v-bind:sociallink="selected"
      v-bind:socialnetworks="socialnetworks"
      v-on:hide:add:sociallink="hideAddForm" 
      v-on:create:sociallink="addItem" 
      ></form-sociallink-add>

    <form-sociallink-update
      v-show="updateformenabled"
      v-bind:sociallink="selected"
      v-bind:socialnetworks="socialnetworks"
      v-on:hide:update:sociallink="hideUpdateForm"
      v-on:update:sociallink="updateItem"
      ></form-sociallink-update>

    <form-sociallink-delete
      v-show="deleteformenabled"
      v-bind:sociallink="selected"
      v-on:hide:delete:sociallink="hideDeleteForm"
      v-on:delete:sociallink="deleteItem"
      ></form-sociallink-delete>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>Title</th>
            <th>SocialN</th>
            <th>Link</th>
            <th>Created</th>
            <th>Modified</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>

        <tbody>
          <row-sociallink 
            is="row-sociallink"
            v-for="(sociallink, index) in contact_sociallinks"
            v-bind:sociallink="sociallink"
            v-bind:index="index"
            v-bind:key="sociallink.id"
            v-on:show-update-form="showUpdateForm(sociallink, index)"
            v-on:show-delete-form="showDeleteForm(sociallink, index)"
          ></row-sociallink>
        </tbody>
 
      </table>
    </div>
  </div>
</template>

<script>

  import FormSociallinkAdd from './FormSociallinkAdd.vue'
  import FormSociallinkUpdate from './FormSociallinkUpdate.vue'
  import FormSociallinkDelete from './FormSociallinkDelete.vue'

  import { PlusIcon } from 'vue-feather-icons'

  export default {
    name: "Sociallinks",

    mounted() {
      this.fetch()
      feather.replace()
    },

    data(){
      return{
        contact_sociallinks: [],
        socialnetworks: [],
        addformenabled: false,
        updateformenabled: false,
        deleteformenabled: false,

        selected: {
          type: Object,
          required: false,
          default: () => {
            return {
              id: 0,
              title: "",
              csocial_id: 0,
              link: "",
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
        axios.get('http://blog.com/api/manage/sociallinks')
          .then(({data}) => {
            this.contact_sociallinks = JSON.parse(JSON.stringify( data.sociallinks ))
            this.socialnetworks = JSON.parse(JSON.stringify( data.socialnetworks ))
            this.addformenabled = false
            this.updateformenabled = false
            this.deleteformenabled = false
          })
      },

      showAddForm(){
        this.selected = {}
        this.addformenabled = true
        this.updateformenabled = false
        this.deleteformenabled = false
      },

      hideAddForm(){
        this.addformenabled = false
      },

      showUpdateForm(sociallink, index){
        this.selected = JSON.parse( JSON.stringify(sociallink) )
        this.selected.index = index
        this.addformenabled = false
        this.updateformenabled = true
        this.deleteformenabled = false
      },

      hideUpdateForm(){
        this.updateformenabled = false
      },

      showDeleteForm(sociallink, index){
        this.selected = JSON.parse(JSON.stringify(sociallink) )
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

      addItem(sociallink){
        this.contact_sociallinks.push( JSON.parse( JSON.stringify(sociallink) ) )
        this.addformenabled = false
        this.selected = {}
      },

      updateRow(sociallink){
        this.updateformenabled = false
        return new Promise((resolve, reject) => {
          this.contact_sociallinks.splice( this.selected.index, 1, 
            JSON.parse( JSON.stringify(sociallink) ) )
          resolve()
        })
      },

      updateItem(sociallink){
        this.updateRow(sociallink).then( this.resetSelected() )
      },

      removeRow(){
        this.deleteformenabled = false
        return new Promise((resolve, reject) => {
          this.contact_sociallinks.splice(this.selected.index, 1)
          resolve()
        })
      },

      deleteItem(){
        this.removeRow().then( this.resetSelected() )
      },

    },

    components: {
      FormSociallinkAdd, FormSociallinkUpdate, FormSociallinkDelete, PlusIcon,
    },
  }
</script>

<style>
</style>
