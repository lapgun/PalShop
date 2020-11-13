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
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h4 class="m-0 font-weight-bold text-primary">Form Create Product</h4>
                            </div>
                        </div>
                        <div class="form">
                            <form @submit.prevent="handleSubmit()">
                                <template v-if="product.id === ''">
                                    <div class="form-group d-flex">
                                        <div class="form-row col-md-6">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input type="text" v-model="product.name" class="form-control"
                                                   placeholder="Name product">
                                            <template v-if="listError.product">
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
                                            <label for="text">{{ __('Choice File') }}</label>
                                            <input type="text" v-model="product.image" class="form-control"
                                                   placeholder="Description">
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
                                    <div class="form-group">
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
                                </template>
                                <template v-else>
                                    <div class="form-group">
                                        <label>Role Type</label>
                                        <select v-model="user.role" class="form-control">
                                            <option value="SUPER">SUPER</option>
                                            <option value="GUEST">GUEST</option>
                                        </select>
                                        <template v-if="listError.role">
                                            <div v-for="error in listError.role"
                                                 class="invalid-feedback">@{{ error }}
                                            </div>
                                        </template>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Status</label>
                                        <select type="text" v-model="user.status" class="form-control">
                                            <option value="true">Active</option>
                                            <option value="false">In-active</option>
                                        </select>
                                        <template v-if="listError.status">
                                            <div v-for="error in listError.status"
                                                 class="invalid-feedback">@{{ error }}
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary">Back</button>
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
    <script src="{{ mix('js/admin/product/create.js') }}"></script>
@endsection
