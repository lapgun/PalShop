import Vue from 'vue';
import axios from 'axios';

let vue = new Vue({
    el: '#admin-site',
    data: {
        user: {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        },
        listUser: [],
        role_type : 'GUEST'
    },
    created() {
        this.getListUser();
    },
    methods: {
        getListUser() {
            axios.get('admin/list-user').then(res => {
                this.listUser = res.data.data;
            }).catch(error => {
                return error.response;
            })
        },
        handleSubmit() {
            if (this.user.password != this.user.password_confirmation) {
                alert('please ! enter password matching password confirm');
            } else {
                axios.post('admin/store', this.user)
                    .then(res => {
                        this.getListUser();
                        this.clearForm();
                    }).catch(error => {
                    return error.response;
                });
            }
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
                    alert('delete success');
                    this.getListUser();
                }).catch(error => {
                return error.response;
            })
        }
    },
});
