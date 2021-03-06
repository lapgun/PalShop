@extends('layouts.app')
@section('main')
    <div id="product-site-create">
        <div id="wrapper">
            <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                @include('layouts.topbar')
                <!-- End of Topbar -->
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <h1 style="font-family: 'Comic Sans MS'"> Form Product </h1>
                        <hr>
                        <div class="form">
                            <form @submit.prevent="handleSubmit()">
                                <div class="form-group d-flex">
                                    <div class="form-row col-md-6">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input type="text" v-model="product.name" class="form-control"
                                               placeholder="Name product">
                                        <template v-if="listError.name">
                                            <div v-for="error in listError.name"
                                                 class="invalid-feedback">@{{ error }}
                                            </div>
                                        </template>
                                    </div>
                                    <div class="form-row col-md-6">
                                        <label for="text">{{ __('Model') }}</label>
                                        <input type="text" v-model="product.model" class="form-control"
                                               placeholder="Model Machine">
                                        <template v-if="listError.model">
                                            <div v-for="error in listError.model"
                                                 class="invalid-feedback">@{{ error }}
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <div class="form-row col-md-6">
                                        <upload-file @change="imageUploaded"></upload-file>
                                        <div class="list-image" style="padding: 4px 0px 0px 26px;">
                                            <template v-for="image in product.image">
                                                <img style="width: 60px; height: 60px; padding-right: 2px" :src="image.full_url_link">
                                            </template>
                                        </div>
                                        <template v-if="listError.image">
                                            <div v-for="error in listError.image"
                                                 class="invalid-feedback">@{{ error }}
                                            </div>
                                        </template>
                                    </div>
                                    <div class="form-row col-md-6">
                                        <label for="text">{{ __('Description') }}</label>
                                        <textarea v-model="product.description" class="form-control"
                                                  placeholder="Description">
                                            </textarea>
                                        <template v-if="listError.description">
                                            <div v-for="error in listError.description"
                                                 class="invalid-feedback">@{{ error }}
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <div class="form-row col-md-6">
                                        <div class="col-md-6">
                                            <label
                                                for="text">{{ __('Weight') }}</label>
                                            <input type="text" v-model="product.weight" class="form-control"
                                                   placeholder="weight">
                                            <template v-if="listError.weight">
                                                <div v-for="error in listError.weight"
                                                     class="invalid-feedback">@{{ error }}
                                                </div>
                                            </template>
                                        </div>
                                        <div class="col-md-6">
                                            <label
                                                for="text">{{ __('Size') }}</label>
                                            <input type="text" v-model="product.size" class="form-control"
                                                   placeholder="size">
                                            <template v-if="listError.size">
                                                <div v-for="error in listError.size"
                                                     class="invalid-feedback">@{{ error }}
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="form-row col-md-6">
                                        <div class="col-md-6">
                                            <label
                                                for="text">{{ __('Quality') }}</label>
                                            <input type="text" v-model="product.quality" class="form-control"
                                                   placeholder="quality">
                                            <template v-if="listError.quality">
                                                <div v-for="error in listError.quality"
                                                     class="invalid-feedback">@{{ error }}
                                                </div>
                                            </template>
                                        </div>
                                        <div class="col-md-6">
                                            <label
                                                for="text">{{ __('Price') }}</label>
                                            <input type="text" v-model="product.price" class="form-control"
                                                   placeholder="VNĐ">
                                            <template v-if="listError.price">
                                                <div v-for="error in listError.price"
                                                     class="invalid-feedback">@{{ error }}
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary">
                                        {{__('common.submit')}}
                                    </button>
                                    <a type="button" class="btn btn-secondary"
                                       href="{{ route('product.index') }}">
                                        {{__('common.back')}}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
            @include('layouts.footer')
            <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
    </div>
@endsection
@section('js')
    <script src="{{ mix('js/admin/product/edit.js') }}"></script>
@endsection
