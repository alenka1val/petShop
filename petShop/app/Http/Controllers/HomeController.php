<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::latest()->limit(6)->get();
        return view('welcome', compact('products'));
    }

    function admin(){
        $orders=Order::all();
        /*foreach ($orders as $order){
            dd($order->address);
        }*/
        return view('admin.index', compact('orders'));
    }
}
