<?php

namespace App\Http\Controllers\Partak;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Partak\ProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('acl', 'products.view');

        $products = Product::available()->paginate(20, ['*'], 'available');
        $soldOut = Product::soldOut()->paginate(20, ['*'], 'soldOut');

        return view('partak.products.index', [
            'products' => $products,
            'soldOut' => $soldOut,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('acl', 'products.add');

        return view('partak.products.create', ['product' => new Product()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Partak\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $product = new Product($data);

        $product->type = 'merchandise';
        if ($request->hasFile('image')) {
            $product->storeImage($request->file('image'));
        }

        $product->save();

        return redirect()->route('partak.products.index')->with([
            'success' => 'Merchandise was created.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->authorize('acl', 'products.view');

        return view('partak.products.show', ['product' => $product, 'sales' => $product->sales()->orderBy('created_at', 'DESC')->paginate(10)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('acl', 'products.edit');

        return view('partak.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Partak\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->fill($data);

        if ($request->hasFile('image')) {
            $product->storeImage($request->file('image'));
        }

        $product->save();

        return redirect()->route('partak.products.index')->with([
            'success' => 'Merchandise updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('acl', 'products.remove');

        $product->delete();

        return redirect()->route('partak.products.index')->with([
            'success' => 'Merchandise deleted.',
        ]);
    }
}
