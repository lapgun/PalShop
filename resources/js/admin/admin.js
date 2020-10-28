import Vue from 'vue';
import axios from 'axios';
import VueSimpleAlert from "vue-simple-alert";
import Paginate from 'vuejs-paginate';

Vue.use(VueSimpleAlert);

const vue = new Vue({
    el: '#admin-site',
    components : {
      Paginate
    },
    data: {
        user: {
            id: '',
            name: '',
            email: '',
            password: '',
            new_password: '',
            password_confirmation: '',
            status: true,
            role: ''
        },
        listError: [],
        listUser: [],

        paginate: {
            'limit': 5,
            'last_page': 0,
            'current_page': 1
        },
        textSearch: '',
    },
    created() {
        this.getListUser();
    },
    methods: {
        getListUser() {
            const url = 'admin/list-user';
            axios.get(url, {
                params: {
                    'limit': this.paginate.limit,
                    'textSearch': this.textSearch
                }
            })
                .then(res => {
                    this.paginate.last_page = res.data.data.last_page;
                    this.listUser = res.data.data.data;
                }).catch(error => {
                this.listError = error.response.data.errors;
            })
        },
        handleSubmit() {
            const urlStore = 'admin/store';
            const urlUpdate = 'admin/update';
            if (this.user.id == '') {
                axios.post(urlStore, this.user)
                    .then(res => {
                        this.getListUser();
                        this.clearForm();
                        this.listError = [];
                        this.$alert('Create successfully sent!', 'Success', 'success');
                        $('#formUser').modal('hide');
                        $("div").removeClass('modal-backdrop');
                    }).catch(error => {
                    this.listError = error.response.data.errors;
                });
            } else {
                axios.put(urlUpdate, this.user)
                    .then(res => {
                        this.getListUser();
                        this.listError = [];
                        this.$alert('Update successfully sent!', 'Success', 'success');
                        $('#formUser').modal('hide');
                        $("div").removeClass('modal-backdrop');
                    }).catch(error => {
                    this.listError = error.response.data.errors;
                });
            }
        },
        clearForm() {
            this.user.id = '';
            this.user.name = '';
            this.user.email = '';
            this.user.password = '';
            this.user.password_confirmation = '';
        },
        handleDeleteUser(id) {
            const url = 'admin/user/';
            axios.delete(url + id)
                .then(res => {
                    this.$alert('Remove user success ?', 'Success', 'success');
                    this.getListUser();
                }).catch(error => {
                this.$alert('Remove user fail ?', 'Warning', 'warning');
            })
        },
        handleCreate() {
            $('#formUser').modal('show');
            this.clearForm();
        },
        handleUpdate(user) {
            $('#formUser').modal('show');
            this.user.id = user.id;
            this.user.role = user.role_type;
            this.user.status = user.active;
        }
    },
});
