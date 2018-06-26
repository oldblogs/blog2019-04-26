<template>
  <div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h4 class="h4">Emails</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
              <a class="btn btn-sm btn-outline-secondary" role="button" href="@">Add</a>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Title</th>
              <th>Email</th>
              <th>Created</th>
              <th>Modified</th>
              <th>Read</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="email in contact_emails">
                <td>{{ email.id }}</td>
                <td>{{ email.title }}</td>
                <td>{{ email.email }}</td>
                <td>{{ email.created_at }}</td>
                <td>{{ email.updated_at }}</td>
                <td><a class="btn btn-sm btn-outline-secondary" role="button" href="#"><book-open-icon class="custom-class"></book-open-icon></a></td>
                <td>
                  @can('edit',$email)
                    <a class="btn btn-sm btn-outline-secondary" role="button" 
                    href="#" ><edit-3-icon class="custom-class"></edit-3-icon></a>
                  @else
                    <button class="btn btn-sm btn-outline-secondary disabled"><edit-3-icon class="custom-class"></edit-3-icon></button>  
                  @endcan
                </td>
            </tr>
          </tbody>
        </table>
        
      </div>
  </div>
</template>

<script>
  import { ActivityIcon, BookOpenIcon, Edit3Icon } from 'vue-feather-icons'  

  export default {

    mounted() {
        this.fetch()
        feather.replace()
    },
    
    data(){
      return{
        contact_emails: [],        
      }
    },

    computed: {

    },

    methods: {
      fetch() {
        axios.get('http://blog.com/api/emails')
          .then(({data}) => {
            this.contact_emails = JSON.parse(JSON.stringify( data.data.emails ))
          })
      }
    },
    components: {
      ActivityIcon, BookOpenIcon, Edit3Icon
    },
  }
</script>

<style>
</style>
