
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


// editor support
import 'v-markdown-editor/dist/v-markdown-editor.css';
import Vue from 'vue'
import Editor from 'v-markdown-editor'

// global register
Vue.use(Editor);
// Support vuex
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"
const store = new Vuex.Store(
    storeData
)
//support moment js
import {filter} from './filter'

// vue router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import {routes} from './routes';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('admin-main', require('./components/admin/AdminMaster.vue'));
Vue.component('home-main', require('./components/public/PublicMaster.vue'));


// V-form
import { Form, HasError, AlertError } from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;


// Sweet alert 2
import swal from 'sweetalert2'
window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', swal.stopTimer)
      toast.addEventListener('mouseleave', swal.resumeTimer)
    }
  })
window.toast = toast


const router = new VueRouter({
    routes,
    mode:'hash',

})


const app = new Vue({
    el: '#app',
    router,
    store
});
