@extends('layouts.app')
@section('main')
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
                            <a href="#" target="blank" class="nav-link "><i class="fas fa-home" aria-hidden="true"></i>
                                Home</a>
                            <a href="#" target="blank" class="nav-link "><i class="fas fa-user"></i> Management User</a>
                            <a href="#" target="blank" class="nav-link "><i class="fab fa-product-hunt"></i> Product</a>
                            <a href="#" target="blank" class="nav-link "><i class="fas fa-image"></i> Photo Library</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="col-lg-10">
            <div class="card">
                <div class="breadcrumb">
                    <a href="#" target="blank" class="nav-link "><i class="fas fa-home" aria-hidden="true"></i> Home</a>
                </div>
                <div class="list-user">
                    <div class="form-data">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Form addd</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"
                                                       placeholder="Password">
                                            </div>
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
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
                                    <th>Order</th>
                                    <th>Description</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th style="text-align:center;width:100px;">Edit</th>
                                    <th style="text-align:center;width:100px;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Alphabet puzzle</td>
                                    <td>2016/01/15</td>
                                    <td>Done</td>
                                    <td>1000</td>
                                    <td style="text-align: center">
                                        <a class="btn btn-info" href="#"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td style="text-align: center">
                                        <a class="btn btn-danger" href="#"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
