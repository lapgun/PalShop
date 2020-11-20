<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <label class="filelabel">
                    <i class="fa fa-paperclip">
                    </i>
                    <span class="title">
                        Add File
                    </span>
                    <input class="FileUpload1 col-md-6" mutilfile id="FileInput" name="booking_attachment" type="file" ref="files" multiple @change="handleFilesUpload()"/>
                </label>
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
            handleFilesUpload() {
                let uploadedFiles = this.$refs.files.files;
                for (let i = 0; i < uploadedFiles.length; i++) {
                    this.files.push(uploadedFiles[i]);
                }
                this.$emit('change', uploadedFiles);
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

    span .remove-file {
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
    .filelabel {
        width: 447px;
        border: 2px dashed grey;
        border-radius: 5px;
        display: block;
        padding: 5px;
        transition: border 300ms ease;
        cursor: pointer;
        text-align: center;
        margin: 0;
    }
    .filelabel i {
        display: block;
        font-size: 30px;
        padding-bottom: 5px;
    }
    .filelabel i,
    .filelabel .title {
        color: grey;
        transition: 200ms color;
    }
    .filelabel:hover {
        border: 2px solid #1665c4;
    }
    .filelabel:hover i,
    .filelabel:hover .title {
        color: #1665c4;
    }
    #FileInput{
        display:none;
    }
</style>
