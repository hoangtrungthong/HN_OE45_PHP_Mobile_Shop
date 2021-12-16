<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function changeLang(Request $request)
    {
        Session::put('language', $request->language);

        return redirect()->back();
    }

    public function index()
    {
        $categories = Category::with('parentCategory', 'childrenCategory')->whereParent(config('const.active'))->get();
        $catePro = Category::with('products')->where('parent', '<>', config('const.active'))->limit(5)->get();

        $products = Product::with([
            'productAttributes',
            'productImages',
        ])
            ->limit(config('const.pagination'))
            ->get();

        return view('home', compact('categories', 'products', 'catePro'));
    }

    public function showProduct($slug)
    {
        $product = Product::with('productAttributes')->whereSlug($slug)->firstOrFail();

        $attr = ProductAttribute::with([
            'colors',
            'memories',
        ])
            ->where('product_id', $product->id)
            ->distinct('color_id')
            ->get();

        $images = ProductImage::where('product_id', $product->id)->get();

        return view('details_product', compact('product', 'attr', 'images'));
    }
}
