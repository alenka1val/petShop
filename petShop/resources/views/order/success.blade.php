@extends('layouts.main')
@section('content')
    <div>
        <div class="container p-3">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit
                    longer so that you can see how spacing within an alert works with this kind of content.
                </p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
            <div class="d-lg-none">
                <form action="{{ route('home') }}">
                    <button class="btn btn-primary btn-block">
                        Presmerovat na uvodnu stranku
                    </button>
                </form>
            </div>
            <div class="d-none d-lg-block d-xl-block">
                <form action="{{ route('home') }}">
                    <button class="btn btn-primary">
                        Presmerovat na uvodnu stranku
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
