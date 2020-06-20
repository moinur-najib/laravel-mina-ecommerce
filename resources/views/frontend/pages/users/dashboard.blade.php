@extends('frontend.pages.users.master')

@section('sub-content')
  <div class='container'>
    <h2>Welcome {{ $user->first_name . ' ' . $user->last_name }} </h2>
    <p>You can change your profile and other informations here</p>

    <hr>

    <div class="row">
      <div class="col-md-4">
        <a href="{{ route('user.profile') }}">
          <div class="card card-body mt-2 pointer">
            Update Profile
          </div>
        </a>
      </div>
    </div>
  </div>
@endsection
