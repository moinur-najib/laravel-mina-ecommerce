@extends('frontend.layouts.master')
@include('frontend.partials.messages')
@section('content')
  <div class='container'>
    <div class="row">
        <div class="col-md-4">
            <div class="list-group">
                <a href="" class="list-group-item">
                <img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" class="w-50 rounded-circle" style="background-color: white; border-color: black;">
                </a>
                <a href="{{ route('user.dashboard') }}" class="list-group-item {{ Route::is('user.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('user.profile') }}" class="list-group-item {{ Route::is('user.profile') ? 'active' : '' }}">Update Profile</a>
                <a href="" class="list-group-item">Logout</a>
                
            </div>
        </div>
        <div class="col-md-8 mt-2">
            <div class="card card-body">
            
                @yield('sub-content')
            </div>
        </div>
    </div>
  </div>
@endsection
