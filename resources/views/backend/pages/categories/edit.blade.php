@extends('backend.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Edit Product
        </div>
        <div class="card-body">

          <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{ $category->name }}">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Description (optional)</label>
              <textarea name="description" rows="8" cols="80" class="form-control">{{ $category->name }}</textarea>

            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Parent Category (optional)</label>
              <select name="parent_id" class="form-control">
              <option value="">Please select a Primary category</option>
                @foreach ($main_categories as $cat)
                  <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
              </select>

            </div>

            <div class="form-group">
              <label for="image">Category Old Image</label>

              
              <img src="{{ asset('images/categories/'. $category->image) }}" style="width: 100px; height: 100px; display: block;"><br>
              <br>
              <label for="oldimage">Category New Image (optional)</label>
              

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
