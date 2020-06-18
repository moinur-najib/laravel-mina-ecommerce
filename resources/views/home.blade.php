@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">Dashboard</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        
                    @endif
                    
                    You are logged in!
                    <a href="{{ route('index') }}" class="d-block py-3 my-3 btn btn-success">Go to our home page</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
