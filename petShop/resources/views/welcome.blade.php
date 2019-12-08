@extends('layouts.main')
@section('content')
    <div>
        <div class="container-fluid p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="img-fluid d-block w-100" src="images/dogs.jpg" alt="">
                        <div class="carousel-caption d-none d-md-block">
                            <h2>Textik</h2>
                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="img-fluid d-block w-100" src="images/dog.jpg" alt="">
                        <div class="carousel-caption d-none d-md-block">
                            <h2>Textik</h2>
                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="container">
            <div>
                <h1 class="pt-3">
                    Products
                </h1>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div class="item col-lg-4 col-md-6 col-sm-7 p-3">
                        <a href="{{ route('product.show', $product->id) }}">
                            <div class="card shadow">
                                <img class="item" src="/images/kitten.jpg" alt="Autumn painting" style="width:100%">
                                <div class="card-body">
                                    <h3>{{ $product->name }}</h3>
                                    <p class="height">{{ $product->description }}</p>
                                    <h4 class="price">${{ $product->price }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
