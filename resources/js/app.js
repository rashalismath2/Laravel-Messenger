/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

export const bus=new Vue();

import App from "./App.vue";
Vue.component("App",App);

const app = new Vue({
    el: '#app',
});