import Vue from 'vue';
import axios from 'axios';
import VueSimpleAlert from "vue-simple-alert";

Vue.use(VueSimpleAlert);

let vue = new Vue({
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
            axios.get('admin/list-user')
                .then(res => {
                    this.listUser = res.data.data;
                }).catch(error => {
                this.listError = error.response.data.errors;
            })
        },
        handleSubmit() {
            axios.post('admin/store', this.user)
                .then(res => {
                    this.getListUser();
                    this.clearForm();
                }).catch(error => {
                this.listError = error.response.data.errors;
            });
        },
        clearForm() {
            this.user.name = '';
            this.user.email = '';
            this.user.password = '';
            this.user.password_confirmation = '';
        },
        handleDeleteUser(id) {
            axios.delete('admin/user/' + id)
                .then(res => {
                    this.$alert('Are you sure?', 'warning', 'warning');
                    this.getListUser();
                }).catch(error => {
                this.$alert('Are you sure?', 'warning', 'warning');
            })
        }
    },
});
