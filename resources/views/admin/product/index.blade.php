@extends('layouts.app')
@section('main')
    <div id="product-site">
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
                                <h4 class="m-0 font-weight-bold text-primary">Management List Product</h4>
                            </div>
                            @if(Auth::user()->role_type == 'SUPER' && Auth::user()->active == true)
                                <div class="add-item">
                                    <a class="btn btn-success mt-3 ml-3 text-white"
                                       href="{{ route('product.create') }}">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                                <div class="card-body d-flex p-0">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="d-flex pt-3" id="dataTable_length">
                                            <div>Show</div>
                                            <div>
                                                <select name="dataTable_length" v-model="paginate.limit"
                                                        @change="getListProduct()"
                                                        class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="dataTable_filter" class="d-flex float-right pt-3">
                                            <span>Search: </span>
                                            <label>
                                                <input type="search" class="form-control form-control-sm"
                                                       v-model="textSearch" @keyup="getListProduct()">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered w-100" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Model</th>
                                                <th>Weight</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Quality</th>
                                                <th class="align-center">{{__('common.edit')}}</th>
                                                <th class="align-center">{{__('common.delete')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(product, index) in listProduct">
                                                <td>@{{ index + 1 }}</td>
                                                <td>@{{ product.name }}</td>
                                                <td>
                                                    <img style="width: 60px; height: 60px" :src="product.images.length > 0 ? product.images[0].url_link : ''">
                                                </td>
                                                <td>@{{ product.description }}</td>
                                                <td>@{{ product.model }}</td>
                                                <td>@{{ product.weight }}</td>
                                                <td>@{{ product.size }}</td>
                                                <td>@{{ product.price }}</td>
                                                <td>@{{ product.quality }}</td>
                                                <td class="align-center">
                                                    <button class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                </td>
                                                <td class="align-center">
                                                    <button class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="align-center text-danger">{{__('common.not_permission')}}</div>
                            @endif
                        </div>
                        <div class="w-100 d-flex">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                                    Showing @{{ paginate.limit }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <paginate v-model="paginate.current_page"
                                          :click-handler="getListProduct"
                                          :page-count="paginate.last_page"
                                          :prev-text="'PREV'" :next-text="'NEXT'"
                                          :container-class="'pagination'"
                                          :page-class="'page-item'"
                                          :page-link-class="'page-link'"
                                          :prev-class="'page-item'"
                                          :prev-link-class="'page-link'"
                                          :next-class="'page-item'"
                                          :next-link-class="'page-link'"
                                          class="float-right" style="margin-top: -9px">
                                </paginate>
                            </div>
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
    <script src="{{ mix('js/admin/product/index.js') }}"></script>
@endsection
