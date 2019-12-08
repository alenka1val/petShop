@extends('layouts.main')
@section('content')
    <div>
        <div class="container p-3">
            <div class="alert alert-success" role="alert">
                <h3>
                    You have been sucessfuly registered!
                </h3>
                <hr>
                <p class="mb-0">
                    Please check your email address {{ Auth::user()->email }}
                    <strong>Please click on a button below to update your profile.
                    </strong>
                </p>
            </div>
            <div class="d-lg-none">
                <form action="{{ route('user.edit', Auth::user()->id) }}">
                    <button class="btn btn-primary submit btn-block">
                        Update profile
                    </button>
                </form>
            </div>
            <div class="d-none d-lg-block d-xl-block">
                <form action="{{ route('user.edit', Auth::user()->id) }}">
                    <button class="btn btn-primary submit">
                        Update profile
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
