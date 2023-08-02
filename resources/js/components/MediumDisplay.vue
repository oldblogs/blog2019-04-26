<template>
  <div>
    <div v-if="medium.medium_type.mtype === 'image'">
      <img v-if="medium.file" :src="'storage/'+medium.file" :key="medium.file" class="card-img-top" style="max-height: 6rem;" alt="" title="" />
      <img v-if="medium.external_url" :src="medium.external_url" :key="medium.external_url" class="card-img-top" style="max-height: 6rem;" alt="" title="" />
    </div>
  </div>
</template>

<script>

  export default {
    name: "MediumDisplay",

    mounted() {
    },

    props: {
      medium: {
        type: Object,
        required: true,
        default: function(){
          return {
            id: 0,
            enabled: false,
            medium_type_id: 0,
            medium_type: {
              id: 0,
              mtype: '',
              msubtype: '',
              mclass: '',
              created_at: '00:00',
              updated_at: '00:00'
            },
            license_id: 0,
            license: {
              id: 0,
              spdx: '',
              lic_name: '',
              lic_deed: '',
              legal: '',
              fsf: false,
              osi: false,
              created_at: '00:00',
              updated_at: '00:00'
            },
            file: '',
            external_url: '',
            stock_url: '',
            stock_desc: '',
            created_at: '00:00',
            updated_at: '00:00',
            index: -1
          }
        },
      },
    },

    computed: {
    },

    methods: {
    },

    components: {
    }
  }
</script>
