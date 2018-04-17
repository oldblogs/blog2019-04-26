<template>
    <div class="col-xs-12">
        <div class="card card-default">
            <div class="card-header">Vue Test</div>

            <div class="card-body">
              Testing AJAX
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            window.axios.get('/api/user')
              .then(response => {
                  console.log(response.data);
              });
        }
    }
</script>
