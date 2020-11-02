import Vue from 'vue';
import VueSimpleAlert from "vue-simple-alert";

Vue.use(VueSimpleAlert);

const vue = new Vue({
    el: '#admin-home',
    mounted() {
        $('.dropdown-toggle').dropdown();
    },
});
