@extends('layouts.main')
@section('content')
    <div>
        <div class="container p-3">
            @if(!Auth::user())
                <div class="alert alert-primary" role="alert">
                    <a href="{{ route('login') }}" class="alert-link">
                        Prihlasit sa pre automaticke vygenerovanie udajov
                    </a>
                </div>
            @endif
            <form action="{{ route('order.store') }}" method="post">
                @csrf
                <div class="row pb-3">
                    <div class="col-lg-6 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="m-0">
                                    Udaje o pouzivatelovi
                                </h4>
                            </div>
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
                                               name="name"
                                               @if(old('name'))
                                               value="{{ old('name') }}"
                                                   @else
                                                   value="{{ (Auth::user() && Auth::user()->name)? Auth::user()->name:'' }}"
                                               @endif
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
                                               placeholder="Priezvisko"
                                               name="surname"
                                               @if(old('surname'))
                                                   value="{{ old('surname') }}"
                                               @else
                                                   value="{{ (Auth::user() && Auth::user()->surname)? Auth::user()->surname:'' }}"
                                               @endif
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
                                               placeholder="Telefonne cislo"
                                               name="phone"
                                               @if(old('phone'))
                                                   value="{{ old('phone') }}"
                                               @else
                                                   value="{{ (Auth::user() && Auth::user()->phone)? Auth::user()->phone:'' }}"
                                               @endif
                                        >
                                        <small id="phone" class="form-text text-muted">
                                            Phone number in: +421987654321
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
                                               placeholder="Email"
                                               name="email"
                                               @if(old('email'))
                                               value="{{ old('email') }}"
                                               @else
                                               value="{{ (Auth::user() && Auth::user()->email)? Auth::user()->email:'' }}"
                                               @endif
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
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="m-0">
                                    Udaje o doruceni
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="p-3">
                                    <h4>
                                        Udaje o doruceni
                                    </h4>
                                    <div class="form-group">
                                        <label for="address">Adresa</label>
                                        <input class="form-control @error('address') is-invalid @enderror"
                                               id="address"
                                               type="text"
                                               placeholder="Adresa"
                                               name="address"
                                               value="{{ old('address') }}"
                                        >
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="city">Mesto</label>
                                        <input class="form-control @error('city') is-invalid @enderror"
                                               id="city"
                                               type="text"
                                               placeholder="Mesto"
                                               name="city"
                                               value="{{ old('city') }}"
                                        >
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="zip">Zip</label>
                                        <input class="form-control @error('zip') is-invalid @enderror"
                                               id="zip"
                                               type="text"
                                               placeholder="Zip"
                                               name="zip"
                                               value="{{ old('zip') }}"
                                        >
                                        @error('zip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="m-0">
                                    Udaje o zaplateni
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="p-3">
                                    <h4>
                                        Udaje o zaplateni
                                    </h4>
                                    <div class="form-group">
                                        <label for="creditCard">Cislo kreditnej karty</label>
                                        <input class="form-control @error('creditCard') is-invalid @enderror"
                                               id="creditCard"
                                               type="text"
                                               placeholder="Cislo kreditnej karty"
                                               name="creditCard"
                                               value="{{ old('creditCard') }}"
                                        >
                                        <small>
                                            Credit card number: 4111111111111111
                                        </small>
                                        @error('creditCard')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cvc">CVC</label>
                                        <input
                                            class="form-control @error('cvc') is-invalid @enderror"
                                            id="cvc"
                                            type="text"
                                            placeholder="CVC"
                                            name="cvc"
                                            value="{{ old('cvc') }}"
                                        >
                                        <small>
                                            CVC example: 1234
                                        </small>
                                        @error('cvc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="expiry">Expiry</label>
                                        <input class="form-control @error('expiry') is-invalid @enderror"
                                               id="expiry"
                                               type="text"
                                               placeholder="Expiry"
                                               name="expiry"
                                               value="{{ old('expiry') }}"
                                        >
                                        @error('expiry')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary float-right btn-lg mb-3">
                    <i class="fas fa-shopping-cart"></i>
                    Buy
                </button>
            </form>
            <form action="{{ route('order.create') }}">
                <button class="btn btn-outline-primary btn-lg float-left mb-3">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </button>
            </form>
        </div>
    </div>
@endsection
