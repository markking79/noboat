/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require ('blueimp-file-upload');

window.Vue = require('vue');

Vue.component('readmore', require('./components/ReadMoreComponent.vue').default);
Vue.component('likePack', require('./components/LikePackComponent.vue').default);
Vue.component('filterPacks', require('./components/FilterPacksComponent.vue').default);

const app = new Vue({
    el: '#app',
});

