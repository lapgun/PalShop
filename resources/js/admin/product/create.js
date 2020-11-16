import Vue from 'vue';
import axios from 'axios';
import VueSimpleAlert from "vue-simple-alert";
import uploadFile from "../../components/UploadFile";
Vue.use(VueSimpleAlert);
const vue = new Vue({
    el: '#product-site-create',
    components : {
        'upload-file': uploadFile
    },
    data: {
        product: {
            id: '',
            name: '',
            image:'',
            description: '',
            model: '',
            size: '',
            weight: '',
            price: '',
            quality: ''
        },
        listError : []
    },
    mounted() {
        $('.dropdown-toggle').dropdown();
    },
    methods: {
        handleSubmit() {
            const urlStore = '/product/store';
            const urlUpdate = '/product/update';
            if (this.product.id == '') {
                axios.post(urlStore, this.product)
                    .then(res => {
                        this.getListProduct();
                        this.clearForm();
                        this.listError = [];
                        this.$alert('Create successfully sent!', 'Success', 'success');
                    }).catch(error => {
                    this.listError = error.response.data.errors;
                });
            } else {
                axios.put(urlUpdate, this.product)
                    .then(res => {
                        this.getListProduct();
                        this.listError = [];
                        this.$alert('Update successfully sent!', 'Success', 'success');
                    }).catch(error => {
                    this.listError = error.response.data.errors;
                });
            }
        },
        clearForm() {
            this.product.id = '';
            this.product.name = '';
            this.product.description = '';
            this.product.size = '';
            this.product.weight = '';
            this.product.model = '';
            this.product.price = '';
            this.product.quality = '';
        },
        //     handleDeleteUser(id) {
        //         const url = 'admin/user/';
        //         axios.delete(url + id)
        //             .then(res => {
        //                 this.$alert('Remove user success ?', 'Success', 'success');
        //                 this.getListUser();
        //             }).catch(error => {
        //             this.$alert('Remove user fail ?', 'Warning', 'warning');
        //         })
        //     },
        handleUpdate(product) {
            this.product.id = product.id;
            this.product.name = product.name;
            this.product.description = product.description;
        },
        imageUploaded(data){
            console.log(data);
            this.product.image = data;
        }
    },
});
