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
                                <h6 class="m-0 font-weight-bold text-primary">Product</h6>
                            </div>
                            @if(Auth::user()->role_type == 'SUPER' && Auth::user()->active == true)
                                <div class="add-item">
                                    <button class="btn btn-success mt-3 ml-3 text-white" data-toggle="modal"
                                            @click="handleCreate()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="card-body d-flex p-0">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="d-flex pt-3" id="dataTable_length">
                                            <div>Show</div>
                                            <div>
                                                <select name="dataTable_length" v-model="paginate.limit"
                                                        @change="getListUser()"
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
                                                       v-model="textSearch"
                                                    {{--                                                       @keyup="getListUser()"--}}
                                                >
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
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
                                                <th style="text-align:center;width:100px;">Edit</th>
                                                <th style="text-align:center;width:100px;">Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mitsubishi</td>
                                                <td>images</td>
                                                <td>chất lương tốt</td>
                                                <td>mẫu 1</td>
                                                <td>200kg</td>
                                                <td>lớn</td>
                                                <td>1.000.000.000</td>
                                                <td>13</td>
                                                <td style="text-align: center">
                                                    <button class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                </td>
                                                <td style="text-align: center">
                                                    <button class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Mitsubishi</td>
                                                <td>images</td>
                                                <td>chất lương tốt</td>
                                                <td>mẫu 1</td>
                                                <td>200kg</td>
                                                <td>lớn</td>
                                                <td>1.000.000.000</td>
                                                <td>13</td>
                                                <td style="text-align: center">
                                                    <button class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                </td>
                                                <td style="text-align: center">
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
                                <div style="text-align: center; color: red">Do not have permission to view data</div>
                            @endif
                        </div>

                        {{--modal Create User--}}
                        {{--                        <div class="modal fade" id="formUser" tabindex="-1" role="dialog"--}}
                        {{--                             aria-labelledby="formUserLabel" aria-hidden="true">--}}
                        {{--                            <div class="modal-dialog" role="document">--}}
                        {{--                                <div class="modal-content">--}}
                        {{--                                    <div class="modal-header">--}}
                        {{--                                        <h5 class="modal-title" id="formUserLabel">Form User</h5>--}}
                        {{--                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--                                            <span aria-hidden="true">&times;</span>--}}
                        {{--                                        </button>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="modal-body">--}}
                        {{--                                        <form @submit.prevent="handleSubmit()">--}}
                        {{--                                            <template v-if="user.id === ''">--}}
                        {{--                                                <div class="form-group">--}}
                        {{--                                                    <label for="name">{{ __('Name') }}</label>--}}
                        {{--                                                    <input type="text" v-model="user.name" class="form-control">--}}
                        {{--                                                    <template v-if="listError.name">--}}
                        {{--                                                        <div v-for="error in listError.name"--}}
                        {{--                                                             class="invalid-feedback">@{{ error }}--}}
                        {{--                                                        </div>--}}
                        {{--                                                    </template>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="form-group">--}}
                        {{--                                                    <label for="email">{{ __('E-Mail Address') }}</label>--}}
                        {{--                                                    <input type="text" v-model="user.email"--}}
                        {{--                                                           class="form-control">--}}
                        {{--                                                    <template v-if="listError.email">--}}
                        {{--                                                        <div v-for="error in listError.email"--}}
                        {{--                                                             class="invalid-feedback">@{{ error }}--}}
                        {{--                                                        </div>--}}
                        {{--                                                    </template>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="form-group">--}}
                        {{--                                                    <label for="password">{{ __('Password') }}</label>--}}
                        {{--                                                    <input type="password" v-model="user.password"--}}
                        {{--                                                           class="form-control">--}}
                        {{--                                                    <template v-if="listError.password">--}}
                        {{--                                                        <div v-for="error in listError.password"--}}
                        {{--                                                             class="invalid-feedback">@{{ error }}--}}
                        {{--                                                        </div>--}}
                        {{--                                                    </template>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="form-group">--}}
                        {{--                                                    <label--}}
                        {{--                                                        for="password-confirm">{{ __('Confirm Password') }}</label>--}}
                        {{--                                                    <input type="password" v-model="user.password_confirmation"--}}
                        {{--                                                           class="form-control">--}}
                        {{--                                                    <template v-if="listError.password_confirmation">--}}
                        {{--                                                        <div v-for="error in listError.password_confirmation"--}}
                        {{--                                                             class="invalid-feedback">@{{ error }}--}}
                        {{--                                                        </div>--}}
                        {{--                                                    </template>--}}
                        {{--                                                </div>--}}
                        {{--                                            </template>--}}
                        {{--                                            <template v-else>--}}
                        {{--                                                <div class="form-group">--}}
                        {{--                                                    <label>Role Type</label>--}}
                        {{--                                                    <select v-model="user.role" class="form-control">--}}
                        {{--                                                        <option value="SUPER">SUPER</option>--}}
                        {{--                                                        <option value="GUEST">GUEST</option>--}}
                        {{--                                                    </select>--}}
                        {{--                                                    <template v-if="listError.role">--}}
                        {{--                                                        <div v-for="error in listError.role"--}}
                        {{--                                                             class="invalid-feedback">@{{ error }}--}}
                        {{--                                                        </div>--}}
                        {{--                                                    </template>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="form-group">--}}
                        {{--                                                    <label for="name">Status</label>--}}
                        {{--                                                    <select type="text" v-model="user.status" class="form-control">--}}
                        {{--                                                        <option value="true">Active</option>--}}
                        {{--                                                        <option value="false">In-active</option>--}}
                        {{--                                                    </select>--}}
                        {{--                                                    <template v-if="listError.status">--}}
                        {{--                                                        <div v-for="error in listError.status"--}}
                        {{--                                                             class="invalid-feedback">@{{ error }}--}}
                        {{--                                                        </div>--}}
                        {{--                                                    </template>--}}
                        {{--                                                </div>--}}
                        {{--                                            </template>--}}
                        {{--                                            <div class="form-group float-right">--}}
                        {{--                                                <button type="submit" class="btn btn-primary">Submit</button>--}}
                        {{--                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">--}}
                        {{--                                                    Close--}}
                        {{--                                                </button>--}}
                        {{--                                            </div>--}}
                        {{--                                        </form>--}}

                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--endModal Create User--}}
                        <div class="w-100 d-flex">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                                    Showing @{{ paginate.limit }} entries
                                </div>
                            </div>
                            {{--                            <div class="col-sm-12 col-md-7">--}}
                            {{--                                <paginate v-model="paginate.current_page"--}}
                            {{--                                          :click-handler="getListUser"--}}
                            {{--                                          :page-count="paginate.last_page"--}}
                            {{--                                          :prev-text="'PREV'" :next-text="'NEXT'"--}}
                            {{--                                          :container-class="'pagination'"--}}
                            {{--                                          :page-class="'page-item'"--}}
                            {{--                                          :page-link-class="'page-link'"--}}
                            {{--                                          :prev-class="'page-item'"--}}
                            {{--                                          :prev-link-class="'page-link'"--}}
                            {{--                                          :next-class="'page-item'"--}}
                            {{--                                          :next-link-class="'page-link'"--}}
                            {{--                                          class="float-right" style="margin-top: -9px">--}}
                            {{--                                </paginate>--}}
                            {{--                            </div>--}}
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
    <script src="{{ mix('js/admin/product.js') }}"></script>
@endsection
