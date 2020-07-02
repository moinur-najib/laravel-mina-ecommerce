@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="card">
            <div class="card-header">
                Manage Slider
            </div>
            <div class="card-body">
                @include('backend.partials.messages')

                <a href="#addSliderModal" data-toggle="modal" class="btn btn-info">
                    <i class="fa fa-plus"></i>Add new slider
                </a>
                <div class="clearfix"></div>

                <!-- Addd Modal -->
                <div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new slider</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('admin.slider.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-ground">
                                        <label for="title">Slider Title <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Slider title" required>
                                    </div>

                                    <div class="form-ground">
                                        <label for="image">Slider Image <small class="text-danger">*</small></label>
                                        <input type="file" class="form-control" name="image" id="image"
                                            placeholder="Slider Image" required>
                                    </div>

                                    <div class="form-ground">
                                        <label for="button_text">Slider Button Text</label>
                                        <input type="text" class="form-control" name="button_text" id="button_text"
                                            placeholder="Slider Button Text">
                                    </div>

                                    <div class="form-ground">
                                        <label for="button_link">Slider Button link</label>
                                        <input type="url" class="form-control" name="button_link" id="button_link"
                                            placeholder="Slider Button Text">
                                    </div>

                                    <div class="form-ground">
                                        <label for="priority">Slider Priority <small
                                                class="text-danger">*</small></label>
                                        <input type="number" class="form-control" name="priority" id="priority"
                                            placeholder="Slider Priority; e.g:10" value="10" required>
                                    </div>

                                    <button type="submit" class="btn btn-success d-inline">Add new
                                        slider</button>
                                    <button type="button" class="btn btn-primary d-inline"
                                        data-dismiss="modal">Cancel</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <table class="table table-hover table-striped">
                    <tr>
                        <th>#</th>
                        <th>Slider Name</th>
                        <th>Slider Image</th>
                        <th>Slider Priority</th>
                        <th>Action</th>
                    </tr>

                    @foreach($sliders as $slider)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $slider->title }}</td>
                        <td>
                            <img src=" {{ asset('images/sliders/'. $slider->image) }} " style="width: 30px;">
                        </td>
                        <td>{{ $slider->priority }}</td>
                        <td>
                            <a href="#editModal{{ $slider->id }}" class="btn btn-warning" data-toggle="modal"
                                data-target="#editModal{{ $slider->id }}">Edit</a>

                            <a href="#deleteModal{{ $slider->id }}" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteModal{{ $slider->id }}">Delete</a>
                            <!-- Modal -->
                            <div class="modal fade" id="editModal{{ $slider->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.slider.update', $slider->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-ground">
                                                    <label for="title">Slider Title <small
                                                            class="text-danger">*</small></label>
                                                    <input type="text" class="form-control" name="title" id="title"
                                                        placeholder="Slider title" required
                                                        value="{{ $slider->title }}">
                                                </div>

                                                <div class="form-ground">
                                                    <label for="image">Slider Image</label>
                                                    <a href=" {{ asset('images/sliders/'. $slider->image) }} "
                                                        target="_blank">Previous
                                                        Image</a>
                                                    <small class="text-danger">*</small>
                                                    <input type="file" class="form-control" name="image" id="image"
                                                        placeholder="Slider Image" required>
                                                </div>

                                                <div class="form-ground">
                                                    <label for="button_text">Slider Button Text</label>
                                                    <input type="text" class="form-control" name="button_text"
                                                        id="button_text" placeholder="Slider Button Text"
                                                        value="{{ $slider->button_text }}">
                                                </div>

                                                <div class="form-ground">
                                                    <label for="button_link">Slider Button link</label>
                                                    <input type="url" class="form-control" name="button_link"
                                                        id="button_link" placeholder="Slider Button Text"
                                                        value="{{ $slider->button_link }}">
                                                </div>

                                                <div class="form-ground">
                                                    <label for="priority">Slider Priority <small
                                                            class="text-danger">*</small></label>
                                                    <input type="number" class="form-control" name="priority"
                                                        id="priority" placeholder="Slider Priority; e.g:10"
                                                        value="{{ $slider->button_link }}" required>
                                                </div>

                                                <button type="submit" class="btn btn-success d-inline">Update
                                                    slider</button>
                                                <button type="button" class="btn btn-primary d-inline"
                                                    data-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteModal{{ $slider->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure about that?</h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{ route('admin.slider.delete', $slider->id) }}" method="post"
                                                enctype="multipart/form-data">

                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                @csrf
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Cancel</button>

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
