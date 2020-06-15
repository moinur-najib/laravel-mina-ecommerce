@extends('backend.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Edit Division
        </div>
        <div class="card-body">

          <form action="{{ route('admin.division.update', $division->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name">Name *</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="form-group">
              <label for="priority">Priority *</label>
              <input type="text" class="form-control" name="priority" id="priority">
            </div>


            <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
            @include('backend.partials.messages')

          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection