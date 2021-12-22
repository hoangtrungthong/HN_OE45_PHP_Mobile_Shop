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
        $product = Product::with([
            'productAttributes',
            'comments' => function ($query) {
                $query->with('user')
                    ->limit(config('const.pagination'))
                    ->orderBy('id', 'DESC');
            },
            'ratings' => function ($query) {
                $query->with('user');
            }
        ])
            ->whereSlug($slug)
            ->firstOrFail();

        $star1 = $product->ratings()->whereVote(config('const.one_stars'))->count() * config('const.percent');
        $star2 = $product->ratings()->whereVote(config('const.two_stars'))->count() * config('const.percent');
        $star3 = $product->ratings()->whereVote(config('const.three_stars'))->count() * config('const.percent');
        $star4 = $product->ratings()->whereVote(config('const.four_stars'))->count() * config('const.percent');
        $star5 = $product->ratings()->whereVote(config('const.five_stars'))->count() * config('const.percent');

        $attr = ProductAttribute::with([
            'colors',
            'memories',
        ])
            ->where('product_id', $product->id)
            ->distinct('color_id')
            ->get();

        $images = ProductImage::where('product_id', $product->id)->get();

        return view('details_product', compact([
            'product',
            'attr',
            'images',
            'star1',
            'star2',
            'star3',
            'star4',
            'star5',
        ]));
    }
}
