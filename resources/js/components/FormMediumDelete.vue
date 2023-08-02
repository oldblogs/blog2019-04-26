<template>
  <div>
    <form v-on:submit.prevent="deleteItem">

      <div class="form-group">
        <button v-on:click="hideform" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <div class="form-group">
          <h4>The following record will be deleted ! Are you sure ? </h4>
        </div>

        <input v-model="medium.id" type="text" class="form-control" style="display: none">
        <div class="card" style="width: 18rem;">
          <img v-if="medium.file" :src="'storage/'+medium.file" :key="medium.file" class="card-img-top" style="max-height: 6rem;" alt="Profile photo" title="" />
          <img v-if="medium.external_url" :src="medium.external_url" :key="medium.external_url" class="card-img-top" style="max-height: 6rem;" alt="Profile photo" title="" />
          <div class="card-body">
            <p class="card-text">{{ medium.description }}
              <span v-if="medium.enabled" class="badge badge-success">Enabled</span>
              <span v-else class="badge badge-secondary">Disabled</span>
            </p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Type: {{ medium.medium_type.mtype }}/{{ medium.medium_type.msubtype }}</li>
            <li class="list-group-item">License: <a :href="medium.license.lic_deed" rel="external" target="_blank">{{ medium.license.spdx }}</a></li>
          </ul>
        </div>
        <div class="form-group">
          <button class="btn btn-danger">Yes, Delete ! </button> 
        </div>

        <div class="form-group" v-show="message">
          <div class="alert alert-danger">
            {{ message }}
          </div>
        </div> 
      </div>
    </form>
  </div>
</template>

<script>
  export default {
    name: "FormMediumDelete",

    mounted() {
    },

    props: {
      medium: {
        type: Object,
        required: false,

        default: function(){
          return {
            id: 0,
            enabled: false,
            description: '',
            medium_type_id: 0,
            license_id: 0,
            file: '',
            external_url: '',
            stock_url: '',
            stock_desc: '',
            created_at: '',
            updated_at: '',
            index: -1,
          }
        },
      },

      data(){
        return{
          message: "",
          errors: "",
        }
      },

      computed: {
      },

      methods: {
        deleteItem(){
          axios.delete(this.$appurl + 'media/' + this.medium.id)
            .then( (response) => {
              this.$emit('delete:media')
              this.errors = "" 
              this.message = "" 
            })
            .catch( (error) => {
              this.message = error.response.data.message 
              this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
            })
        },
        hideForm(){
          this.$emit('hide:delete:medium')
        },
      },
    },
  }

</script>

<style>
</style>