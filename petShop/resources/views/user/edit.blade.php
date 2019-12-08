@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="pt-3 pb-3">
            <form method="post" action="{{ route('user.update', $user->id) }}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-actions">
                            <div class="float-left">
                                <h1>
                                   Edit
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="p-3">
                                <h4>
                                    Udaje o pouzivatelovi
                                </h4>
                                <div class="form-group">
                                    <label for="name">Meno</label>
                                    <input class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           type="text"
                                           placeholder="{{ (Auth::user() && Auth::user()->name)? Auth::user()->name:'Meno' }}"
                                           value="{{ (Auth::user() && Auth::user()->name)? Auth::user()->name:'' }}"
                                           name="name"
                                    >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="surname">Priezvisko</label>
                                    <input class="form-control @error('surname') is-invalid @enderror"
                                           id="surname"
                                           type="text"
                                           placeholder="{{ (Auth::user() && Auth::user()->surname)? Auth::user()->surname:'Priezvisko' }}"
                                           value="{{ (Auth::user() && Auth::user()->surname)? Auth::user()->surname:'' }}"
                                           name="surname"
                                    >
                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Telefonne cislo</label>
                                    <input class="form-control @error('phone') is-invalid @enderror"
                                           id="phone"
                                           type="text"
                                           placeholder="{{ (Auth::user() && Auth::user()->phone)? Auth::user()->phone:'Telefonne cislo' }}"
                                           value="{{ (Auth::user() && Auth::user()->phone)? Auth::user()->phone:'' }}"
                                           name="phone"
                                    >
                                    <small id="phone" class="form-text text-muted">
                                        Telefónne číslo v tvare: +421987654321
                                    </small>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           type="email"
                                           placeholder="{{ (Auth::user() && Auth::user()->email)? Auth::user()->email:'Email' }}"
                                           value="{{ (Auth::user() && Auth::user()->email)? Auth::user()->email:'' }}"
                                           name="email"
                                    >
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary submit float-right">
                            <i class="fas fa-user-edit"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
