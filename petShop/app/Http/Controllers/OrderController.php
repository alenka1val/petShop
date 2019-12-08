<?php

namespace App\Http\Controllers;

use App\Address;
use App\Order;
use App\OrderItem;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->session()->get('products'));
        if ($request->session()->get('products')) {
            $sum = 0;
            $items = array();
            foreach ($request->session()->get('products') as $item) {
                $product = Product::where('id', $item['id'])->get()[0];
                array_push($items, $product);
                $sum += ($product->price * $item['piece']);
            }
            return view('order.index', compact('items', 'sum'));
        }
        return view('order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create2(Request $request)
    {
        $request->validate([
            'transport' => 'required',
            'payment' => 'required',
        ]);

        $request->session()->put('transport', $request->transport);
        $request->session()->put('payment', $request->payment);
        return view('order.create2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => ['required'],
            'city' => ['required'],
            'zip' => ['required', 'numeric', 'regex:/^[0-9]{5}$/'],
            'creditCard' => ['required', 'regex:/^[0-9]{14,17}$/'],
            'cvc' => ['required', 'regex:/^[0-9]{4}$/'],
            'expiry' => ['required', 'regex:/^[0-9]{2}$/'],
        ]);
        if (Auth::user() == null) {
            $request->validate([
                'name' => ['required'],
                'surname' => ['required'],
                'phone' => ['regex:/(\+4219)[0-9]{8}/'],
                'email' => ['required', 'regex:/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/'],
            ]);
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
        } else {
            $user = Auth::user();
        }

        $address = Address::create([
            'zip' => $request->zip,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $address->id,
            'transport' => $request->session()->get('transport'),
            'payment' => $request->session()->get('payment'),
            'creditCard' => $request->creditCard,
            'cvc' => $request->cvc,
            'expiry' => $request->expiry,

        ]);

        foreach ($request->session()->get('products') as $item) {
            if ($product = Product::where('id', $item['id'])->first()) {
                $product->on_stock -= $item['piece'];
                $product->save();
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['piece'],
                ]);
            }
        }

        Session()->forget('products');
        Session()->forget('transport');
        Session()->forget('payment');
        Session()->save();

        return view('order.success');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->session()->get('products.' . $id)) {
            dd($request->session()->get('products.' . $id));
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if($order->status=='pending_payment'){
            $order->status='processing';
            $order->save();
        }else{
            if($order->status=='processing'){
                $order->status='ready';
                $order->save();
            }else{
                if($order->status=='ready'){
                    $order->status='completed';
                    $order->save();
                }else{
                    $order->delete();
                    return response()->json(['status'=>'success','msg' => 'Order deleted successfully']);
                }
            }
        }
        return response()->json(['status'=>'success','msg' => 'Order updated successfully']);
    }


    public function plus(Request $request, Product $product)
    {
        $number = $request->session()->get('products.' . $product->id . '.piece') + 1;
        if ($number <= $product->on_stock) {
            $request->session()->put('products.' . $product->id . '.piece', $number);
            return redirect()->route('order.index');
        } else {
            abort(404);
        }

    }

    public function minus(Request $request, Product $product)
    {
        $number = $request->session()->get('products.' . $product->id . '.piece') - 1;
        if ($number > 0) {
            $request->session()->put('products.' . $product->id . '.piece', $number);
            return redirect()->route('order.index');
        } else {
            abort(404);
        }

    }

    public function deleteSession(Request $request, Product $product)
    {
        if ($request->session()->get('products.' . $product->id)) {
            $request->session()->forget('products.' . $product->id);
            $request->session()->save();
        }

        return redirect()->route('order.index');
    }


    public function list($page) {
        // get rowsPerPage from query parameters (after ?), if not set => 5
        $rowsPerPage = request('rowsPerPage', 5);

        // get sortBy from query parameters (after ?), if not set => name
        $sortBy = request('sortBy', 'name');

        // get descending from query parameters (after ?), if not set => false
        $descendingBool = request('descending', 'false');
        // convert descending true|false -> desc|asc
        $descending = $descendingBool === 'true' ? 'desc' : 'asc';

        // pagination
        // IFF rowsPerPage == 0, load ALL rows
        if ($rowsPerPage == 0) {
            // load all products from DB
            $products = Order::orderBy($sortBy, $descending)
                ->get();
        } else {
            $offset = ($page - 1) * $rowsPerPage;

            // load products from DB
            $products = Order::orderBy($sortBy, $descending)
                ->offset($offset)
                ->limit($rowsPerPage)
                ->with('user')
                ->with('address')
                ->get();
        }

        // total number of rows -> for quasar data table pagination
        $rowsNumber = Order::count();

        return response()->json(['rows' => $products, 'rowsNumber' => $rowsNumber]);
    }
}
