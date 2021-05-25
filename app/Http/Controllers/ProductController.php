<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Jobs\ProductCreated;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Notifications\ProductCreated as NotificationsProductCreated;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('Product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('Product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = Product::create($request->validated());
        $categories = [];

        if(array_key_exists('categories', $request->all()))
            $categories = array_filter($request->all()['categories'], fn($var) => $var != 'null');

        $product->categories()->sync($categories);

        ProductCreated::dispatch(new NotificationsProductCreated($product))
            ->delay(Carbon::now()->addMinutes(15));

        return Redirect::route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('Product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('Product.edit', [
            'product' => $product, 
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        $categories = [];

        if(array_key_exists('categories', $request->all()))
            $categories = array_filter($request->all()['categories'], fn($var) => $var != 'null');

        $product->categories()->sync($categories);

        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return Redirect::back();
    }
}
