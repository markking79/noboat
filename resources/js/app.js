/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require ('blueimp-file-upload');
import VueExpandableImage from 'vue-expandable-image'

window.Vue = require('vue');

Vue.component('readmore', require('./components/ReadMoreComponent.vue').default);
Vue.component('likePack', require('./components/LikePackComponent.vue').default);
Vue.component('filterPacks', require('./components/FilterPacksComponent.vue').default);

Vue.use(VueExpandableImage);

const app = new Vue({
    el: '#app',
});

