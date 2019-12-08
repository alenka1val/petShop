@extends('layouts.main')
@section('content')
    <div>
        <div class="container">
            <div class="p-3">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-7 p-3 justify-content-md-center">
                        <img class="img-fluid w-100" src="/images/kitten.jpg" width="400" height="400">

                        <div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-7 p-3">
                        <div>
                            <h1>{{ $product->name }}</h1>
                            <p class="d-none d-sm-block height">
                                {{ $product->description }}
                            </p>
                        </div>
                        <hr class="d-none d-sm-block">
                        <div>
                            <table class="table table-sm table-borderless">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <h2 class="pb-0 mb-0">
                                            Cena
                                        </h2>
                                    </th>
                                    <td scope="col" align="right">
                                        <h2 class="pb-0 mb-0">
                                            {{ $product->price }} €
                                        </h2>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <small class="pt-0 mt-0">
                                            Cena bez DPH
                                        </small>
                                    </td>
                                    <td align="right">
                                        <small class="pt-0 mt-0">
                                            {{ $product->price/100*79 }} €
                                        </small>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="float-left">
                                <p>
                                    Na sklade {{ $product->on_stock }} ks
                                </p>
                            </div>
                            <div class="float-right">
                                <form action="{{ route('product.prestore', $product->id) }}">
                                    <button class="btn btn-primary btn-lg">
                                        <i class="fas fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <nav>
                    <div class="item nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active"
                           id="nav-home-tab"
                           data-toggle="tab"
                           href="#nav-home"
                           role="tab"
                           aria-controls="nav-home"
                           aria-selected="true"
                        >
                            Information
                        </a>
                        <a class="nav-item nav-link"
                           id="nav-profile-tab"
                           data-toggle="tab"
                           href="#nav-profile"
                           role="tab"
                           aria-controls="nav-profile"
                           aria-selected="false"
                        >
                            Parameters
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card p-3">
                            <h4>{{ $product->name }}</h4>
                            <p>
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card p-3">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                @foreach($product->parameters as $parameter)
                                <tr>
                                    <th scope="row">{{ $parameter->type }}</th>
                                    <td>{{ $parameter->value }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
