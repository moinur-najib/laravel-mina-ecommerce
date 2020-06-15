@extends('backend.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Add a District
        </div>
        <div class="card-body">
        <h1>Create Post</h1>

          <form action="{{ route('admin.district.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('backend.partials.messages')
            <div class="form-group">
              <label for="name">Name *</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="form-group">
              <label for="division_id">Select a division for this districts</label>
              <select class="form-control" name="division_id">
                <option value="">Please select a division for this districts</option>
                  @foreach ($divisions as $division)
                    <option value="{{ $division->id }}"> {{ $division->name }} </option>
                  @endforeach
              </select>
            </div>

            <button type="submit" class="btn btn-primary mb-3">Add District</button>

          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection