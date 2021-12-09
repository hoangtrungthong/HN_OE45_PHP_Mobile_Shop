<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $num = config('const.block');
        $products = Product::with([
            'category',
            'productAttributes',
            'productImages',
        ])
            ->orderBy('id', 'desc')
            ->paginate(config('const.pagination'));

        return view('admin.products.index', compact(['products', 'num']));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::with(['productAttributes'])->where('slug', $slug)->firstOrFail();
        $attr = ProductAttribute::with([
            'colors',
            'memories',
        ])
            ->where('product_id', $product->id)
            ->get();
           
        $img = ProductImage::where('product_id', $product->id)->get();

        return view('admin.products.details', compact(['product', 'attr', 'img']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $product->delete();
            $product->productAttributes()->delete();
            $product->productImages()->delete();
            
            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
        }
    }
}
