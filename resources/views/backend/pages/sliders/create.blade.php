@extends('backend.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Add Division
        </div>
        <div class="card-body">
        <h1>Create Post</h1>
        @include('backend.partials.messages')

          <form action="{{ route('admin.division.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name">Name *</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="form-group">
              <label for="priority">Priority *</label>
              <input type="text" class="form-control" name="priority" id="priority">
            </div>

            <button type="submit" class="btn btn-primary mb-3">Add Division</button>

          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection