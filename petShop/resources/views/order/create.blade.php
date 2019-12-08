@extends('layouts.main')
@section('content')
    <article>
        <div class="container p-3">
            <form action="{{ route('order.create2') }}">
                @csrf
                @if (count($errors)>=2)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Please, enter <strong>transport and payment method</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @else
                    @error('transport')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Please, enter <strong>transport</strong>. {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                    @error('payment')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Please enter <strong>payment method</strong>. {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">
                            Transport
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-9 col-form-label">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        id="personal"
                                        type="radio"
                                        value="personal"
                                        name="transport"
{{--
                                        @if(is_array(old('transport')) && in_array('personal', old('transport') )) checked @endif
--}}
                                    >
                                    <label class="form-check-label" for="personal">personal subscription</label>
                                </div>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        id="kurier"
                                        type="radio"
                                        value="kurier"
                                        name="transport"
{{--
                                        @if(is_array(old('transport')) && in_array('kurier', old('transport') )) checked @endif
--}}
                                    >
                                    <label class="form-check-label" for="kurier">Courier delivery</label>
                                </div>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        id="postOffice"
                                        type="radio"
                                        value="postOffice"
                                        name="transport"
{{--
                                        @if(is_array(old('transport')) && in_array('postOffice', old('transport') )) checked @endif
--}}
                                    >
                                    <label class="form-check-label" for="postOffice">Post office</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">
                            Payment method
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-9 col-form-label">
                                <div class="form-check">
                                    <input class="form-check-input" id="bank" type="radio" value="bank" name="payment">
                                    <label class="form-check-label" for="bank">Bank transfer</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="check" type="radio" value="cash" name="payment">
                                    <label class="form-check-label" for="check">In cash</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="creditCart" type="radio" value="creditCart" name="payment">
                                    <label class="form-check-label" for="creditCart">Credit card</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <button class="btn btn-primary submit">
                        Pokracovat
                    </button>
                </div>
            </form>
            <div class="float-left">
                <form action="{{ route('order.index') }}">
                    <button class="btn btn-outline-primary">
                        Spat
                    </button>
                </form>
            </div>

        </div>
    </article>
@endsection
