<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h4 class="h4">Test List</h4>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary" v-on:click="showAddForm"><plus-icon class="custom-class"></plus-icon>Add</button>
        </div>
      </div>
    </div>
      <form-test-add v-show="addformenabled" v-on:create:test="fetch" v-on:hide:add:test="hideAddForm" ></form-test-add>

      <form-test-update
        v-show="updateformenabled"
        v-bind:stest="selected"
        v-on:update:test="fetch"
        v-on:hide:update:test="hideUpdateForm"
        ></form-test-update>

      <form-test-delete
        v-show="deleteformenabled"
        v-bind:stest="selected"
        v-on:delete:test="fetch"
        v-on:hide:delete:test="hideDeleteForm"
        ></form-test-delete>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#ID</th>
              <th>text</th>
              <th>Created</th>
              <th>Modified</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="test in tests" v-bind:key="test.id">
              <td>{{ test.id }}</td>
              <td>{{ test.title }}</td>
              <td>{{ test.created_at }}</td>
              <td>{{ test.updated_at }}</td>

              <td>
                <button class="btn btn-sm btn-outline-secondary test-update" v-on:click="showUpdateForm(test)" ><edit-3-icon class="custom-class"></edit-3-icon></button>
              </td>
              <td>
                <button class="btn btn-sm btn-outline-secondary test-delete" v-on:click="showDeleteForm(test)" ><trash-2-icon class="custom-class"></trash-2-icon></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</template>

<script>

  import FormTestAdd from './FormTestAdd.vue'
  import FormTestUpdate from './FormTestUpdate.vue'
  import FormTestDelete from './FormTestDelete.vue'

  import { PlusIcon , BookOpenIcon, Edit3Icon, Trash2Icon} from 'vue-feather-icons'

  export default {
    name: "Tests",

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
        tests: {},
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
            }
          },
        },
      }
    },

    computed: {

    },

    methods: {
      fetch() {
        axios.get('http://blog.com/api/manage/tests')
          .then(({data}) => {
            this.tests = JSON.parse(JSON.stringify( data.data.tests ))
            this.addformenabled = false
            this.updateformenabled = false
            this.deleteformenabled = false
          })
      },
      
      showAddForm(){
        this.addformenabled = true
        this.updateformenabled = false
        this.deleteformenabled = false
      },

      hideAddForm(){
        this.addformenabled = false
      },

      showUpdateForm(item){
        this.selected = JSON.parse(JSON.stringify( item ))
        this.addformenabled = false
        this.updateformenabled = true
        this.deleteformenabled = false
      },

      hideUpdateForm(){
        this.updateformenabled = false
      },

      showDeleteForm(item){
        this.selected = JSON.parse(JSON.stringify( item ))
        this.addformenabled = false
        this.updateformenabled = false
        this.deleteformenabled = true
      },

      hideDeleteForm(){
        this.deleteformenabled = false
      },

    },
    components: {
      FormTestAdd, FormTestUpdate, FormTestDelete, PlusIcon, BookOpenIcon, Edit3Icon, Trash2Icon,
    },
  }
</script>

<style>
</style>
