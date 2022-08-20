/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 window.Vue = require('vue').default;

 import Vuetify from 'vuetify';
 import axios from 'axios';
 import Vuex from 'vuex';
 import VueRouter from 'vue-router'
 import Vue from 'vue';
 import store from './store/store.js';
 import VueMoment from 'vue-moment';
 import moment from 'moment';
 
 require('moment/locale/es');
 
 axios.interceptors.response.use(
     function (response) {
         return response;
     },
     function (error) {
         if (!!error && !!error.response && !!error.response.status && 401 === error.response.status) {
             app.$store.dispatch("setLogout");
             app.$router.push("/");
         } else {
             return Promise.reject(error);
         }
     }
 );
 
 Vue.use(Vuex);
 Vue.use(VueRouter);
 Vue.use(Vuetify);
 Vue.use(VueMoment, {
     moment
 });
 
 import App from './components/app.vue'
 
 export default new Vuetify({
     icons: {
         values: {
         },
     },
 })
 

 // Others
 Vue.component('app', require('./components/app.vue').default);
 Vue.component('Header', require('./components/header.vue').default);
 Vue.component('Footer', require('./components/footer.vue').default);

 Vue.component('home_calendario', require('./components/fragments/home/home_calendario.vue').default);
 Vue.component('home_bottom', require('./components/fragments/home/home_bottom.vue').default);
 Vue.component('home_clasificacion', require('./components/fragments/home/home_clasificacion.vue').default);
 Vue.component('home_partido', require('./components/fragments/home/home_partido.vue').default);

 Vue.component('nuevo_jugador', require('./components/dialogs/plantilla_nuevo_jugador.vue').default);

 const routes = [
     { path: '/', component: ("app").default },
     { path: '/home', component: require("./components/views/home.vue").default},
     { path: '/plantilla', component: require("./components/views/plantilla.vue").default},
 ]
 
 const router = new VueRouter({
     routes: routes,
     base: "/",
     mode: "history"
 })
 
 const app = new Vue({
     el: '#app',
     components: { App },
     vuetify: new Vuetify(),
     router: router,
     store
 });
 