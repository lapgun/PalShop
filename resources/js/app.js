
import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueSimpleAlert from "vue-simple-alert";

window.Vue = Vue;
Vue.use(VueRouter);
Vue.use(VueSimpleAlert);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);




