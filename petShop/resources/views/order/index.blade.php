@extends('layouts.main')
@section('content')
    <div>
        <div class="container p-3">
            @if(!empty($items))
            <div class="alert alert-warning" role="alert">
                Last add <strong>{{ $items[count($items)-1]->name }}</strong> item
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h1>
                Cart
            </h1>
            <div class="card m-1">
                @foreach($items as $item)
                    <div class="card-body">
                        <div class="float-left pr-3">
                            <img src="/images/kitten.jpg" alt="Denim Jeans" style="width:100px">
                        </div>
                        <form action="{{ route('order.deleteSession',$item['id']) }}">
                            <button class="btn btn-link float-right">
                                <i class="fas fa-times fa-1x"></i>
                            </button>
                        </form>
                        {{ $item->name }}
                        <br>
                        <h4>
                            {{ $item->price }} €
                        </h4>
                    </div>
                    <div class="card-footer p-0 ">
                        <div class="float-left pt-2 pl-2">
                            <h5>
                                {{ $item->price*session()->get('products.'.$item['id'].'.piece') }} €
                            </h5>
                        </div>
                        <div class="float-right">
                            <div class="input-group">
                                <input data-value="{{ session()->get('products.'.$item['id'].'.piece') }}" value="{{ session()->get('products.'.$item['id'].'.piece') }}" type="number" class="form-control" readonly>
                                <form action="{{ route('order.plus',$item['id']) }}">
                                    <button class="btn btn-outline-primary">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                                <form action="{{ route('order.minus',$item['id']) }}">
                                    <button class="btn btn-outline-primary">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <table class="table table-sm table-borderless">
                <thead>
                <tr>
                    <th scope="col">
                        <h2 class="pb-0 mb-0">
                            Celkom
                        </h2>
                    </th>
                    <td scope="col" align="right">
                        <h2 class="pb-0 mb-0">
                            {{ $sum }} €
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
                            {{ $sum*0.79 }} €
                        </small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form action="{{ route('home') }}">
                            <button class="btn btn-outline-primary">
                                Pokracovat v nakupe
                            </button>
                        </form>
                    </td>
                    <td align="right">
                        <form action="{{ route('order.create') }}">
                            <button class="btn btn-primary float-right">
                                <i class="fas fa-shopping-cart "></i>
                                Kupit
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
                @else
                <h1>
                    Empty cart
                </h1>
            @endif
        </div>
    </div>
@endsection
