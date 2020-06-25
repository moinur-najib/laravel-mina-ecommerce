@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="card card-body">
            <h2 class="text-center">Welcome to your Admin Panel! <span>
                    {{ Auth::check() ? 'you are logged in!' : 'You are so not logged in mission failed' }} </span></h2>
            <br>
            <br>
            <a href="{{ route('index') }}" class="btn btn-primary btn-lg">Visit Main Site</a>
        </div>

    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a
                    href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                    class="mdi mdi-heart text-danger"></i></span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->
@endsection
