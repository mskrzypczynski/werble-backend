require('./bootstrap');

window.Vue = require('vue');

Vue.component(
    'events',
    require('./components/Events.vue')
);

const app = new Vue({
    el: '#app'
});