<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <input type="file" id="files" ref="files" multiple @change="handleFilesUpload()"/>
            </div>
        </div>
        <div class="large-12 medium-12 small-12 cell">
            <div v-for="(file, key) in files" :key="key" class="file-listing">
                {{ file.name }}
                <span>
                    <a class="remove-file" @click="removeFile( key )">
                        <i class="fas fa-times"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                files: []
            };
        },
        methods: {
            // submitFiles() {
            //     if (!this.checkFilesValid()) {
            //         console.log(
            //             "%cMax file is 5, please remove some picsture",
            //             "color: red; font-size: 20px;"
            //         );
            //     }
            // else {
            //     let formData = new FormData();
            //     for (let i = 0; i < this.files.length; i++) {
            //         formData.append("files", this.files[i]);
            //     }
            //    axios.post("/gallery/upload", formData, {
            //             headers: { "Content-Type": "multipart/form-data" }
            //         })
            //         .then(response => {
            //             this.$emit("uploaded", { productImageInfo: response.data.data });
            //             this.files = "";
            //         })
            //         .catch(error => {
            //             console.log(
            //                 "%cOops! something went wrong!",
            //                 "color: red; font-size: 20px;"
            //             );
            //             console.log(error);
            //         });
            // }
            // },
            handleFilesUpload() {
                let uploadedFiles = this.$refs.files.files;
                for (let i = 0; i < uploadedFiles.length; i++) {
                    this.files.push(uploadedFiles[i]);
                }
                this.$emit('change',uploadedFiles);
            },
            removeFile(key) {
                this.files.splice(key, 1);
            },
            checkFilesValid() {
                return this.files.length <= 5;
            }
        }
    };
</script>
<style scoped>
    div.file-listing {
        width: 200px;
    }

    span .remove-file{
        color: red;
        cursor: pointer;
        float: right;
    }

    div button {
        margin-left: 14px;
    }

    div input {
        margin-left: -15px;
    }
</style>
