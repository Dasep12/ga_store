@extends('components.layouts.frontend.app')

@section('content')
<div class="container my-5">
    @if($error)
    <div class="row justify-content-center g-5">
        <div class="col-12 col-lg-6 text-center order-lg-1"><img class="img-fluid w-lg-100 d-light-none" src="{{ asset('assets/assets/img/spot-illustrations/500-illustration.png')}}" alt="" width="400"><img class="img-fluid w-md-50 w-lg-100 d-dark-none" src="{{ asset('assets/assets/img/spot-illustrations/dark_500-illustration.png')}}" alt="" width="540"></div>
        <div class="col-12 col-lg-6 text-center text-lg-start"><img class="img-fluid mb-6 w-50 w-lg-75 d-dark-none" src="{{ asset('assets/assets/img/spot-illustrations/500.png')}}" alt=""><img class="img-fluid mb-6 w-50 w-lg-75 d-light-none" src="{{ asset('assets/assets/img/spot-illustrations/dark_500.png')}}" alt="">
            <h2 class="text-body-secondary fw-bolder mb-3">Unknown error!</h2>
            <p class="text-body mb-5">{{ $message }}</p><a class="btn btn-lg btn-primary" href="{{ url('/') }}">Go Home</a>
        </div>
    </div>
    @else
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header bg-danger">
                    <h4 class="text-white">Order Reject</h4>
                </div>
                <div class="card-body">
                    <h1 class="fs-1"><i class="far fa-window-close"></i></h1>
                    <p>{{ $message }}</p>
                    <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection