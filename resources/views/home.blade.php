@extends('layouts.app')
@section('main')
    <div id="admin-home">
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
                    <div class="container-fluid"> Welcome to Admin</div>

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
    <script src="{{ mix('js/admin/home.js') }}"></script>
@endsection
