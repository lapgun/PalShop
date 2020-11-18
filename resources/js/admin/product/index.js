import Vue from 'vue';
import axios from 'axios';
import VueSimpleAlert from "vue-simple-alert";
import Paginate from 'vuejs-paginate';

Vue.use(VueSimpleAlert);

const vue = new Vue({
    el: '#product-site',
    components: {
        Paginate
    },
    data: {
        listProduct: [],
        paginate: {
            'limit': 5,
            'last_page': 0,
            'current_page': 1
        },
        textSearch: '',
    },
    created() {
        this.getListProduct();
    },
    mounted() {
        $('.dropdown-toggle').dropdown();
    },
    methods: {
        getListProduct() {
            const url = 'product/list-product';
            axios.get(url, {
                params: {
                    'limit': this.paginate.limit,
                    'textSearch': this.textSearch,
                    'page': this.paginate.current_page
                }
            })
                .then(res => {
                    this.paginate.last_page = res.data.data.last_page;
                    this.listProduct = res.data.data.data;
                })
        },
        handleDeleteProduct(id) {
            const url = 'product/';
            axios.delete(url + id)
                .then(res => {
                    this.getListProduct();
                    this.$alert('Remove user success ?', 'Success', 'success');
                }).catch(error => {
                this.$alert('Remove user fail ?', 'Warning', 'warning');
            })
        },
    },
});
