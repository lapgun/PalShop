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
                    <a href="{{ route('home') }}" class="nav-link "><i class="fas fa-home" aria-hidden="true"></i> Home</a>
                </div>
                <div class="list-user">
                    <h1>welcome to admin site</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
