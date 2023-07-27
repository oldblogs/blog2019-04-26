
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.feather = require('feather-icons');

window.VueFeatherIcon = require('vue-feather-icons');

window.mavonEditor = require('mavon-editor');


Vue.prototype.$apiprefix = 'api';
Vue.prototype.$apimanage = 'manage';
Vue.prototype.$appurl = 'http://blog.com/'+ this.$apiprefix + '/' + this.$apimanage + '/';

// Laravel Vue Pagination 
Vue.component( 'pagination'                     , require( 'laravel-vue-pagination') );

// Laravel Passport
Vue.component( 'passport-clients'               , require('./components/passport/Clients.vue').default );
Vue.component( 'passport-authorized-clients'    , require('./components/passport/AuthorizedClients.vue').default );
Vue.component( 'passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue').default );

// About
Vue.component( 'about'                          , require('./components/About.vue').default );

// Test
Vue.component( 'tests'                          , require('./components/Tests.vue').default );
Vue.component( 'form-test-add'                  , require('./components/FormTestAdd.vue').default );
Vue.component( 'form-test-update'               , require('./components/FormTestUpdate.vue').default );
Vue.component( 'form-test-delete'               , require('./components/FormTestDelete.vue').default );
Vue.component( 'row-test'                       , require('./components/RowTest.vue').default );

// Contact - Emails
Vue.component( 'emails'                         , require('./components/Emails.vue').default );
Vue.component( 'form-email-add'                 , require('./components/FormEmailAdd.vue').default );
Vue.component( 'form-email-update'              , require('./components/FormEmailUpdate.vue').default );
Vue.component( 'form-email-delete'              , require('./components/FormEmailDelete.vue').default );
Vue.component( 'row-email'                      , require('./components/RowEmail.vue').default );

// Contact - Social Network Links
Vue.component( 'sociallinks'                    , require('./components/Sociallinks.vue').default );
Vue.component( 'form-sociallink-add'            , require('./components/FormSociallinkAdd.vue').default );
Vue.component( 'form-sociallink-update'         , require('./components/FormSociallinkUpdate.vue').default );
Vue.component( 'form-sociallink-delete'         , require('./components/FormSociallinkDelete.vue').default );
Vue.component( 'row-sociallink'                 , require('./components/RowSociallink.vue').default );

// Posts
Vue.component( 'posts'                          , require('./components/Posts.vue').default );
Vue.component( 'form-post-view'                 , require('./components/FormPostView.vue').default );
Vue.component( 'form-post-add'                  , require('./components/FormPostAdd.vue').default );
Vue.component( 'form-post-update'               , require('./components/FormPostUpdate.vue').default );
Vue.component( 'form-post-delete'               , require('./components/FormPostDelete.vue').default );
Vue.component( 'row-post'                       , require('./components/RowPost.vue').default );

// Media
Vue.component( 'media'                          , require('./components/Media.vue').default );
Vue.component( 'form-medium-view'               , require('./components/FormMediumView.vue').default );
// Vue.component( 'form-medium-add'                , require('./components/FormMediumAdd.vue').default );
Vue.component( 'form-medium-update'             , require('./components/FormMediumUpdate.vue').default );
// Vue.component( 'form-medium-delete'             , require('./components/FormMediumDelete.vue').default );
Vue.component( 'row-medium'                     , require('./components/RowMedium.vue').default );
Vue.component( 'medium-display'                 , require('./components/MediumDisplay.vue').default ); 

Vue.use(mavonEditor)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
