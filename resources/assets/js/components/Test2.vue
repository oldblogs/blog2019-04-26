<template>
    <div>
        <pre>
            {{ contact_emails }}
        <hr/>

        <hr/>
        </pre>
    </div>
</template>

<script>
  export default {

    props: {

    },

    mounted() {
        this.fetch()    
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
    
  }

</script>

<style>
</style>
