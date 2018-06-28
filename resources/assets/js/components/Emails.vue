<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h4 class="h4">Emails</h4>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary" v-on:click="addToggle"><plus-icon class="custom-class"></plus-icon>Add</button>
        </div>
      </div>
    </div>
      <form-email v-show="showAddForm" v-on:create:email="fetch" ></form-email>
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
                <a class="btn btn-sm btn-outline-secondary" role="button" 
                  href="#" ><edit-3-icon class="custom-class"></edit-3-icon></a>
              </td>
              <td>
                <button class="btn btn-sm btn-outline-secondary" v-on:click="deletemail(email)" ><trash-2-icon class="custom-class"></trash-2-icon></button>
              </td>
            </tr>
          </tbody>
          
        </table>
        
      </div>
  </div>
</template>

<script>
  import { PlusIcon , BookOpenIcon, Edit3Icon, Trash2Icon} from 'vue-feather-icons'  

  export default {

    mounted() {
      self = this 
      this.fetch()
      feather.replace()
    },
    
    data(){
      return{
        self: {},
        contact_emails: [],        
        showAddForm: false,
      }
    },

    computed: {

    },

    methods: {
      fetch() {
        axios.get('http://blog.com/api/manage/emails')
          .then(({data}) => {
            this.contact_emails = JSON.parse(JSON.stringify( data.data.emails ))
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
      addToggle(){
        this.showAddForm = !this.showAddForm
      }
    },
    components: {
      PlusIcon, BookOpenIcon, Edit3Icon, Trash2Icon
    },
  }
</script>

<style>
</style>