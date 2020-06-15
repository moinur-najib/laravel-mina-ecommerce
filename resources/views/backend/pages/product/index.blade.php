@extends('backend.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Manage Products
        </div>
        <div class="card-body">
        @include('backend.partials.messages')

          <table class="table table-hover table-striped">
            <tr>
              <th>#</th>
              <th>Product Title</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>

          @foreach($products as $product)
            <tr>

                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success">Edit</a>

                <a href="#deleteModal{{ $product->id }}" class="btn btn-warning" data-toggle="modal" data-target="#deleteModal{{ $product->id }}">Delete</a>
                  <!-- Modal -->
                  <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Are you sure about that?</h5>

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                        <form action="{{ route('admin.products.delete', $product->id) }}" method="post" enctype="multipart/form-data">
                          
                          <button type="submit" class="btn btn-danger">Delete</button>
                          @csrf
                        </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>

                        </div>
                      </div>
                    </div>
                  </div>
                </td>

            </tr>
          @endforeach
            
          </table>

        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
