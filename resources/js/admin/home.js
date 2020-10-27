import Vue from 'vue';
// import axios from 'axios';
import VueSimpleAlert from "vue-simple-alert";

Vue.use(VueSimpleAlert);

const vue = new Vue({
    el: '#admin-home',
    mounted() {
        $('.dropdown-toggle').dropdown();
    },
    methods:{
        // handelLogout(){
        //     axios.post('/logout')
        //         .then(res => {
        //             console.log(res);
        //         })
        // }
    }
});
