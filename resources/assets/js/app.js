
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.feather = require('feather-icons');

window.VueFeatherIcon = require('vue-feather-icons');

/*
Vue.component( 'test',
  require('./components/Test.vue')
);

Vue.component( 'test2',
  require('./components/Test2.vue')
);
*/



Vue.component( 'form-email-update' , require('./components/FormEmailUpdate.vue') );

Vue.component( 'form-email-add'    , require('./components/FormEmailAdd.vue') );

Vue.component( 'emails'            , require('./components/Emails.vue') );

Vue.component( 'passport-clients'  , require('./components/passport/Clients.vue') );

Vue.component( 'passport-authorized-clients', require('./components/passport/AuthorizedClients.vue') );

Vue.component( 'passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue') );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
