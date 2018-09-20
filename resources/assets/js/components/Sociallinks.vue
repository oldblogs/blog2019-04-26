<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h4 class="h4">Social Links</h4>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary" v-on:click="showAddForm"><plus-icon class="custom-class"></plus-icon>Add</button>
        </div>
      </div>
    </div>
      <form-sociallink-add v-show="addformenabled" v-on:create:sociallink="fetch" v-on:hide:add:sociallink="hideAddForm" ></form-sociallink-add>

      <form-sociallink-update
        v-show="updateformenabled"
        v-bind:sociallink="selected"
        v-on:update:sociallink="fetch"
        v-on:hide:update:sociallink="hideUpdateForm"
        ></form-sociallink-update>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#ID</th>
              <th>SocialN</th>
              <th>Title</th>
              <th>Link</th>
              <th>Created</th>
              <th>Modified</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>

          <tbody >
            <tr v-for="sociallink in contact_sociallinks" v-bind:key="sociallink.id">
              <td>{{ sociallink.id }}</td>
              <td>{{ sociallink.csocial_id }}</td>
              <td>{{ sociallink.title }}</td>
              <td>{{ sociallink.link }}</td>
              <td>{{ sociallink.created_at }}</td>
              <td>{{ sociallink.updated_at }}</td>
              <td>
                <button class="btn btn-sm btn-outline-secondary email-update" v-on:click="showUpdateForm(sociallink)" ><edit-3-icon class="custom-class"></edit-3-icon></button>
              </td>
              <td>
                <button class="btn btn-sm btn-outline-secondary email-delete" v-on:click="deletesociallink(sociallink)" ><trash-2-icon class="custom-class"></trash-2-icon></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</template>

<script>

  import FormSociallinkAdd from './FormSociallinkAdd.vue'
  import FormSociallinkUpdate from './FormSociallinkUpdate.vue'

  import { PlusIcon , BookOpenIcon, Edit3Icon, Trash2Icon} from 'vue-feather-icons'

  export default {
    name: "Sociallinks",

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
        contact_sociallinks: [],
        addformenabled: false,
        updateformenabled: false,

        selected: {
          type: Object,
          required: false,
          default: () => {
            return {
              id: 0,
              csocial_id: 0,
              title: "",
              link: "",
            }
          },
        },
      }
    },

    computed: {

    },

    methods: {
      fetch() {
        axios.get('http://blog.com/api/manage/sociallinks')
          .then(({data}) => {
            this.contact_sociallinks = JSON.parse(JSON.stringify( data.data.sociallinks ))
            this.addformenabled = false
            this.updateformenabled = false
          })
      },

      deletesociallink(sociallink){

        axios.delete('http://blog.com/api/manage/sociallinks/'+sociallink.id)
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

      showUpdateForm(sociallink){
        this.selected = JSON.parse( JSON.stringify( sociallink ) )
        this.updateformenabled = true
        this.addformenabled = false
      },

      hideUpdateForm(){
        this.updateformenabled = false
      }

    },
    components: {
      FormSociallinkAdd, FormSociallinkUpdate, PlusIcon, BookOpenIcon, Edit3Icon, Trash2Icon,
    },
  }
</script>

<style>
</style>
