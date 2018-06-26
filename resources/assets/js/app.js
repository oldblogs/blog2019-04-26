
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.feather = require('feather-icons');

window.VueFeatherIcon = require('vue-feather-icons');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*
Vue.component( 'test', 
  require('./components/Test.vue') 
);

Vue.component( 'test2', 
  require('./components/Test2.vue') 
);
*/

Vue.component( 'emails', 
  require('./components/Emails.vue') 
);

const app = new Vue({
    el: '#app',

});




