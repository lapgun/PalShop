@extends('layouts.app')

@section('main')
    <div id="admin-site">
        <div class="row">
            <div class="col-lg-2">
                <div class="list-group">
                    <div class="card">
                        <div class="card-body">
                            <a id="shmenulinks" class="nav-link"
                               style="border-radius: 0.25rem; cursor: pointer; width: 100%;" data-toggle="collapse"
                               aria-expanded="true" aria-controls="menulinks" data-target="#menulinks"><i
                                    class="fa fa-bars" aria-hidden="true"></i> Open/Close menu</a>
                            <div id="menulinks" class="nav nav-pills collapse">
                                <a href="{{ route('home') }}" class="nav-link "><i class="fas fa-home"
                                                                                   aria-hidden="true"></i> Home</a>
                                <a href="{{ route('admin.index') }}" class="nav-link "><i class="fas fa-user"></i>
                                    Management User</a>
                                <a href="#" class="nav-link "><i class="fab fa-product-hunt"></i> Product</a>
                                <a href="#" class="nav-link "><i class="fas fa-image"></i> Photo Library</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="content" class="col-lg-10">
                <div class="card">
                    <div class="breadcrumb">
                        <a href="{{ route('admin.index') }}" class="nav-link "><i class="fas fa-user"></i> Management
                            User</a>
                    </div>
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
                                                <input type="text" v-model="user.name" class="form-control" >
                                                <template v-if="listError.name">
                                                    <div v-for="error in listError.name" class="invalid-feedback">@{{ error }}</div>
                                                </template>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">{{ __('E-Mail Address') }}</label>
                                                <input  type="text" v-model="user.email" class="form-control" >
                                                <template v-if="listError.email">
                                                    <div v-for="error in listError.email" class="invalid-feedback">@{{ error }}</div>
                                                </template>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">{{ __('Password') }}</label>
                                                <input type="password" v-model="user.password" class="form-control">
                                                <template v-if="listError.password">
                                                    <div v-for="error in listError.password" class="invalid-feedback">@{{ error }}</div>
                                                </template>
                                            </div>
                                            <div class="form-group">
                                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                                <input type="password" v-model="user.password_confirmation" class="form-control" >
                                                <template v-if="listError.password_confirmation">
                                                    <div v-for="error in listError.password_confirmation" class="invalid-feedback">@{{ error }}</div>
                                                </template>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="list-data">
                            <table class="table table-striped table-bordered">
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
                                                <button class="btn btn-danger" @click="handleDeleteUser(user.id)">
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
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ mix('js/admin/admin.js') }}"></script>
@endsection
