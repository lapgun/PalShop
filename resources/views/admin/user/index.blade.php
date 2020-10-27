@extends('layouts.app')
@section('main')
    <div id="admin-site">
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
                                <h6 class="m-0 font-weight-bold text-primary">Management User</h6>
                            </div>
                            <div class="add-item">
                                <button class="btn btn-success mt-3 ml-3" data-toggle="modal" data-target="#exampleModal" style="color:#ffffff"><i class="fas fa-plus"></i></button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role Type</th>
                                            <th>Status</th>
                                            <th style="text-align:center;width:100px;">Edit</th>
                                            <th style="text-align:center;width:100px;">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(user,index) in listUser">
                                            <td>@{{ index + 1 }}</td>
                                            <td>@{{ user.name }}</td>
                                            <td>@{{ user.email }}</td>
                                            <td>@{{ user.role_type }}</td>
                                            <template v-if="user.active == '1'">
                                                <td>
                                                    <span class="badge badge-success">Active</span>
                                                </td>
                                            </template>
                                            <template v-else>
                                                <td>
                                                    <span class="badge badge-secondary">Inactive</span>
                                                </td>
                                            </template>
                                            <td style="text-align: center">
                                                <button class="btn btn-info"><i class="fas fa-edit"></i></button>
                                            </td>
                                            <td style="text-align: center">
                                                <template v-if="role_type != user.role_type">
                                                    <button class="btn btn-danger" disabled>
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </template>
                                                <template v-else>
                                                    <button class="btn btn-danger"
                                                            @click="handleDeleteUser(user.id)">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </template>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{--modal--}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                <input type="text" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Message:</label>
                                                <textarea class="form-control" id="message-text"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Send message</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--endModal--}}


                        <div id="content" class="col-lg-12">
                            <div class="card">
                                <div class="list-user">
                                    <div class="form-data">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center">Form Management User</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <form @submit.prevent="handleSubmit()">
                                                        <div class="form-group">
                                                            <label for="name">{{ __('Name') }}</label>
                                                            <input type="text" v-model="user.name" class="form-control">
                                                            <template v-if="listError.name">
                                                                <div v-for="error in listError.name"
                                                                     class="invalid-feedback">@{{ error }}
                                                                </div>
                                                            </template>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">{{ __('E-Mail Address') }}</label>
                                                            <input type="text" v-model="user.email"
                                                                   class="form-control">
                                                            <template v-if="listError.email">
                                                                <div v-for="error in listError.email"
                                                                     class="invalid-feedback">@{{ error }}
                                                                </div>
                                                            </template>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password">{{ __('Password') }}</label>
                                                            <input type="password" v-model="user.password"
                                                                   class="form-control">
                                                            <template v-if="listError.password">
                                                                <div v-for="error in listError.password"
                                                                     class="invalid-feedback">@{{ error }}
                                                                </div>
                                                            </template>
                                                        </div>
                                                        <div class="form-group">
                                                            <label
                                                                for="password-confirm">{{ __('Confirm Password') }}</label>
                                                            <input type="password" v-model="user.password_confirmation"
                                                                   class="form-control">
                                                            <template v-if="listError.password_confirmation">
                                                                <div v-for="error in listError.password_confirmation"
                                                                     class="invalid-feedback">@{{ error }}
                                                                </div>
                                                            </template>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary float-right">
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    <script src="{{ mix('js/admin/admin.js') }}"></script>
@endsection
