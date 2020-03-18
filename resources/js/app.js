require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter);

let routes = [
  { path: '/foo', component: require('./components/ExampleComponent.vue').default },
  { path: '/bar', component: require('./components/ExampleComponent.vue').default }
];

const router = new VueRouter({
  routes
})


Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
    router
});
