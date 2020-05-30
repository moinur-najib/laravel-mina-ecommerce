@extends('backend.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Edit Brand
        </div>
        <div class="card-body">

          <form action="{{ route('admin.brand.update', $brand->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{ $brand->name }}">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Description (optional)</label>
              <textarea name="description" rows="8" cols="80" class="form-control">{{ $brand->name }}</textarea>

            </div>

            <div class="form-group">
              <label for="image">Brand Old Image</label>

              
              <img src="{{ asset('images/brands/'. $brand->image) }}" style="width: 100px; height: 100px; display: block;"><br>
              <br>
              <label for="oldimage">Brand New Image (optional)</label>
              

                    <input type="file" class="form-control" name="image" id="image">
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
