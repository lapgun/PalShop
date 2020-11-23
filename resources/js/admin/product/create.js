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
    },
    methods: {
        handleSubmit() {
            const urlStore = '/product/store';
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
                axios.post(urlStore, formData)
                    .then(res => {
                        this.listError = [];
                        location.href = 'http://127.0.0.1:8000/product';
                        this.$alert('Create successfully sent!', 'Success', 'success');
                    }).catch(error => {
                    this.listError = error.response.data.errors;
                });
        },
        imageUploaded(data) {
            this.product.image = Object.values(data);
        }
    },
});
