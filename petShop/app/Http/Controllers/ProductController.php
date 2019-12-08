<?php

namespace App\Http\Controllers;

use App\Parameter;
use App\Photo;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource and filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $request->categories;
        $order = $request->order;
        $animal = $request->animal;

        if (!$categories || $categories == 'none') {
            if (!$order || $order == 'none') {
                if (!$animal || $animal == 'none') {
                    //ALL
                    $products = Product::paginate(3);
                } else {
                    //Animal
                    $products = Product::where('animal', $animal)->paginate(3);
                }
            } else {
                $fill = explode('_', $order);
                if ($animal == 'none') {
                    //Orderby
                    $products = Product::orderBy($fill[0], $fill[1])->paginate(3);
                } else {
                    //Animal & Orderby
                    $products = Product::where('animal', $animal)->orderBy($fill[0], $fill[1])->paginate(3);
                }

            }
        } else {
            if ($order == 'none') {
                if ($animal == 'none') {
                    //Categories
                    $products = Product::where('categories', $categories)->paginate(3);
                } else {
                    //Categories & Animal
                    $products = Product::where('animal', $animal)->where('categories', $categories)->paginate(3);
                }
            } else {
                $fill = explode('_', $request->order);
                if ($animal == 'none') {
                    //Category & Order
                    $products = Product::where('categories', $categories)->orderBy($fill[0], $fill[1])->paginate(3);
                } else {
                    //Animal & Category & Orderby
                    $products = Product::where('animal', $animal)->where('categories', $categories)->orderBy($fill[0], $fill[1])->paginate(3);
                }
            }
        }
        return view('product.index', compact(['products', 'animal', 'categories', 'order']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'animal' => 'required',
            'category' => 'required',
            'price' => ['required', 'numeric', 'min:0.01'],
            'description' => ['required', 'min:100'],
            'on_stock' => ['required', 'numeric'],
            /*'parameter.*.type' => 'required',
            'parameter.*.value' => 'required',*/
        ]);


        $product = Product::create([
            'name' => $request->name,
            'animal' => $request->animal,
            'categories' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'on_stock' => $request->on_stock,
        ]);


        return response()->json(['id' => $product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //dd($product->id);
        $product = Product::where('id', $product->id)->with('photos')->first();
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // validations and error handling is up to you!!! ;)
        /*
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
        ]);
        */

        $product->name = $request->name;
        $product->price = $request->price;
        $product->on_stock = $request->on_stock;
        $product->description = $request->description;
        $product->save();

        return response()->json(['id' => $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {

        foreach ($product->parameters as $parameter) {
            $parameter->delete();
        }

        if($orderitem=$product->orderitem){
            $orderitem->delete();
        }

        Storage::deleteDirectory('documents/'.$product->id);

        $product->delete();
        // error handling is up to you!!! ;)
        return response()->json(['status'=>'success','msg' => 'Product deleted successfully']);
    }


    public function prestore(Request $request, Product $product)
    {

        if ($request->session()->get('products.' . $product->id)) {
            $number = $request->session()->get('products.' . $product->id . '.piece') + 1;
            $request->session()->put('products.' . $product->id . '.piece', $number);
        } else {
            $request->session()->put(['products.' . $product->id . '.id' => $product->id, 'products.' . $product->id . '.piece' => 1]);
        }
        return redirect()->route('order.index');
    }


    public function deleteSession(Request $request)
    {
        $request->session()->forget('products');
        $request->session()->save();
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
            $products = Product::orderBy($sortBy, $descending)
                ->get();
        } else {
            $offset = ($page - 1) * $rowsPerPage;

            // load products from DB
            $products = Product::orderBy($sortBy, $descending)
                ->offset($offset)
                ->limit($rowsPerPage)
                ->get();
        }

        // total number of rows -> for quasar data table pagination
        $rowsNumber = Product::count();

        return response()->json(['rows' => $products, 'rowsNumber' => $rowsNumber]);
    }


    public function upload(Product $product, Request $request){
        if($files = $request->files){
            $filename = basename($request->file->store('documents/'.$product->id));

            Photo::create([
                'product_id' => $product->id,
                'filename' => $filename
            ]);
        }
    }


    public function destroyPhoto(Product $product, Photo $photo)
    {
        Storage::delete('documents/'.$product->id.'/'.$photo->filename);

        $photo->delete();
        // error handling is up to you!!! ;)
        return response()->json(['status'=>'success','msg' => 'Product deleted successfully']);
    }
}
