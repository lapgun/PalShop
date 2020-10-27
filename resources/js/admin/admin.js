import Vue from 'vue';
import axios from 'axios';
import VueSimpleAlert from "vue-simple-alert";

Vue.use(VueSimpleAlert);

const vue = new Vue({
    el: '#admin-site',
    data: {
        user: {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        },
        listError: [],
        listUser: [],
        role_type: 'GUEST'
    },
    created() {
        this.getListUser();
    },
    methods: {
        getListUser() {
            const url = 'admin/list-user';
            axios.get(url)
                .then(res => {
                    this.listUser = res.data.data;
                }).catch(error => {
                this.listError = error.response.data.errors;
            })
        },
        handleSubmit() {
            const url = 'admin/store';
            axios.post(url, this.user)
                .then(res => {
                    this.getListUser();
                    this.clearForm();
                    this.listError = [];
                    this.$alert('Form was successfully sent!', 'Success', 'success');
                }).catch(error => {
                this.listError = error.response.data.errors;
                this.$alert('Form was fail sent!', 'Warning', 'warning');
            });
        },
        clearForm() {
            this.user.name = '';
            this.user.email = '';
            this.user.password = '';
            this.user.password_confirmation = '';
        },
        handleDeleteUser(id) {
            const url = 'admin/user/';
            axios.delete(url + id)
                .then(res => {
                    this.$alert('Are you sure?', 'Warning', 'warning');
                    this.getListUser();
                }).catch(error => {
                this.$alert('Are you sure?', 'Warning', 'warning');
            })
        }
    },
});
