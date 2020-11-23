import Vue from 'vue';
import axios from 'axios';
import VueSimpleAlert from "vue-simple-alert";
import uploadFile from "../../components/UploadFile";
import router from "vue-router";

Vue.use(VueSimpleAlert);
Vue.use(router);
const vue = new Vue({
    el: '#product-site-create',
    components: {
        'upload-file': uploadFile
    },
    data: {
        product: {
            id: '',
            name: '',
            image: [],
            description: '',
            model: '',
            size: '',
            weight: '',
            price: '',
            quality: ''
        },
        listError: []
    },
    mounted() {
        $('.dropdown-toggle').dropdown();
        this.getProductById();
    },
    methods: {
        getProductById() {
            const pathname = location.pathname.split('/', 4);
            const productId = pathname[3];
            const urlGetProductById = '/product/item/';
            axios.get(urlGetProductById + productId)
                .then(res => {
                    const response = res.data.data;
                    console.log(response);
                    this.product.id = response.id;
                    this.product.name = response.name;
                    this.product.image = response.images;
                    this.product.model = response.model;
                    this.product.description = response.description;
                    this.product.price = response.price;
                    this.product.quality = response.quality;
                    this.product.size = response.size;
                    this.product.weight = response.weight;
                }).catch(error => {
                this.listError = error.response.data.errors;
            })
        },
        handleSubmit() {
            const urlUpdate = '/product/update';
            const formData = new FormData;
            for (const key in this.product) {
                if (Array.isArray(this.product[key])) {
                    for (const item of this.product[key]) {
                        formData.append(key + '[]', item);
                    }
                } else {
                    formData.append(key, this.product[key]);
                }
            }
            axios.put(urlUpdate, this.product)
                .then(res => {
                    this.getListProduct();
                    this.listError = [];
                    this.$alert('Update successfully sent!', 'Success', 'success');
                }).catch(error => {
                this.listError = error.response.data.errors;
            });
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
        handleUpdate(product) {
            this.product.id = product.id;
            this.product.name = product.name;
            this.product.description = product.description;
        },
        imageUploaded(data) {
            this.product.image = Object.values(data);
        }
    },
});
