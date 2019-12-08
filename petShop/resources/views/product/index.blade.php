@extends('layouts.main')
@section('content')
    <div>
        <div class="container p-3">
            <article>
                <div>
                    <form method="get" action="{{ route('product.index')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12 p-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="animal">Animal</label>
                                    </div>
                                    <select class="custom-select" id="animal" name="animal">
                                        <option value="none" {{ (($animal && $animal=='none') || !$animal ) ? 'selected': '' }}>Choose...</option>
                                        <option value="cat" {{ ($animal && $animal=='cat') ? 'selected': '' }}>Cat</option>
                                        <option value="dog" {{ ($animal && $animal=='dog') ? 'selected': '' }}>Dog</option>
                                        <option value="fish" {{ ($animal && $animal=='fish') ? 'selected': '' }}>Fish</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 p-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="categories">Subcategory</label>
                                    </div>

                                    <select class="custom-select" id="categories" name="categories">
                                        <option value="none" {{ (($categories && $categories=='none') || !$categories ) ? 'selected': '' }} selected>Choose...</option>
                                        <option value="toy" {{ ($categories && $categories=='toy') ? 'selected': '' }}>Toy</option>
                                        <option value="food" {{ ($categories && $categories=='food') ? 'selected': '' }}>Food</option>
                                        <option value="stuff"{{ ($categories && $categories=='stuff') ? 'selected': '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 p-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="order">Order</label>
                                    </div>
                                    <select class="custom-select" id="order" name="order">
                                        <option value="none" {{ (($order && $order=='none') || !$order ) ? 'selected': '' }}>Choose...</option>
                                        <option value="price_asc" {{ ($order && $order=='price_asc') ? 'selected': '' }}>Najlacnejsie</option>
                                        <option value="price_desc" {{ ($order && $order=='price_desc') ? 'selected': '' }}>Najdrahsie</option>
                                        <option value="name_asc" {{ ($order && $order=='name_asc') ? 'selected': '' }}>A-Z</option>
                                        <option value="name_desc" {{ ($order && $order=='name_desc') ? 'selected': '' }}>Z-A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-3 col-md-6 col-sm-12 p-1">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </article>
            @if(count($products)>0)
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
            @endif
        </div>
        <div class="row justify-content-center">
            {{ $products->appends(['animal'=>$animal, 'order' =>$order , 'categories'=>$categories])->render() }}
        </div>
    </div>
@endsection
