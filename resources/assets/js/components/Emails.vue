<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h4 class="h4">Emails</h4>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary" v-on:click="showAddForm"><plus-icon class="custom-class"></plus-icon>Add</button>
        </div>
      </div>
    </div>
      <form-email-add v-show="addformenabled" v-on:create:email="fetch" v-on:hide:add:email="hideAddForm" ></form-email-add>

      <form-email-update
        v-show="updateformenabled"
        v-bind:smail="selected"
        v-on:update:email="fetch"
        v-on:hide:update:email="hideUpdateForm"
        ></form-email-update>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Title</th>
              <th>Email</th>
              <th>Created</th>
              <th>Modified</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>

          <tbody >
            <tr v-for="email in contact_emails" v-bind:key="email.id">
              <td>{{ email.id }}</td>
              <td>{{ email.title }}</td>
              <td>{{ email.email }}</td>
              <td>{{ email.created_at }}</td>
              <td>{{ email.updated_at }}</td>

              <td>
                <button class="btn btn-sm btn-outline-secondary email-update" v-on:click="showUpdateForm(email)" ><edit-3-icon class="custom-class"></edit-3-icon></button>
              </td>
              <td>
                <button class="btn btn-sm btn-outline-secondary email-delete" v-on:click="deletemail(email)" ><trash-2-icon class="custom-class"></trash-2-icon></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</template>

<script>

  import FormEmailAdd from './FormEmailAdd.vue'
  import FormEmailUpdate from './FormEmailUpdate.vue'

  import { PlusIcon , BookOpenIcon, Edit3Icon, Trash2Icon} from 'vue-feather-icons'

  export default {
    name: "Emails",

    mounted() {
      self = this
      this.fetch()
      feather.replace()
    },

    props: {
      anObject: Object
    },

    data(){
      return{
        self: {},
        contact_emails: [],
        addformenabled: false,
        updateformenabled: false,

        selected: {
          type: Object,
          required: false,
          default: () => {
            return {
              id: 0,
              title: "",
              email: "",
            }
          },
        },
      }
    },

    computed: {

    },

    methods: {
      fetch() {
        axios.get('http://blog.com/api/manage/emails')
          .then(({data}) => {
            this.contact_emails = JSON.parse(JSON.stringify( data.data.emails ))
            this.addformenabled = false
            this.updateformenabled = false
          })
      },

      deletemail(email){

        axios.delete('http://blog.com/api/manage/emails/'+email.id)
          .then(function(response){
            console.log('record deleted')
          })
          .catch(function(error){
            console.log('error')
          })
          .then(function(response){
              self.fetch()
          })
      },

      showAddForm(){
        this.addformenabled = true
        this.updateformenabled = false
      },

      hideAddForm(){
        this.addformenabled = false
      },

      showUpdateForm(email){
        this.selected = JSON.parse(JSON.stringify( email ))
        this.updateformenabled = true
        this.addformenabled = false
      },

      hideUpdateForm(){
        this.updateformenabled = false
      }

    },
    components: {
      FormEmailAdd, FormEmailUpdate, PlusIcon, BookOpenIcon, Edit3Icon, Trash2Icon,
    },
  }
</script>

<style>
</style>
