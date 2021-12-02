<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Color;
use App\Models\Memory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        $categories = Category::all();
        $colors = Color::all();
        $memories = Memory::all();

        return view(
            'admin.products.create',
            compact([
                'categories',
                'colors',
                'memories',
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only(['category_id', 'name', 'content', 'specifications']);
            $data['slug'] = Str::slug($request->name);
            $color = $request->color_id;
            $memory = $request->memory_id;
            $price = $request->price;
            $product = Product::create($data);
            if (!$product) {
                return redirect()->back()->withErrors('error');
            }

            foreach ($request->quantity as $key => $item) {
                ProductAttribute::create([
                    'product_id' => $product->id,
                    'quantity' => $item,
                    'color_id' => $color[$key],
                    'memory_id' => $memory[$key],
                    'price' => $price[$key],
                ]);
            };

            foreach ($request->files as $files) {
                foreach ($files as $file) {
                    $img = uploadFile('files', config('path.PRODUCT_UPLOAD_PATH'), $request, $file);
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $img,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.products.index')->withSuccess('Success');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
        }
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
