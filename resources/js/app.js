
import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';

window.Vue = Vue;
Vue.use(VueRouter);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);




