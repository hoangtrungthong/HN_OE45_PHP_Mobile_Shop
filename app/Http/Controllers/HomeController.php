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
        $products = Product::orderBy('id', 'DESC')
            ->paginate(config('const.pagination'));

        $categories = Category::with('childrenCategory')
            ->whereParent(config('const.active'))
            ->get();

        return view('home', compact('products', 'categories'));
    }

    public function showProduct($slug)
    {
        $product = Product::with(
            [
                'productAttributes' => function ($query) {
                    $query->with('colors', 'memories');
                },
                'comments' => function ($query) {
                    $query->with('user')
                        ->limit(config('const.pagination'))
                        ->orderBy('id', 'DESC');
                },
                'ratings' => function ($query) {
                    $query->with('user');
                },
                'productImages',
            ]
        )
            ->whereSlug($slug)
            ->firstOrFail();

        $star1 = $product->ratings()->whereVote(config('const.one_stars'))->count() * config('const.percent');
        $star2 = $product->ratings()->whereVote(config('const.two_stars'))->count() * config('const.percent');
        $star3 = $product->ratings()->whereVote(config('const.three_stars'))->count() * config('const.percent');
        $star4 = $product->ratings()->whereVote(config('const.four_stars'))->count() * config('const.percent');
        $star5 = $product->ratings()->whereVote(config('const.five_stars'))->count() * config('const.percent');

        return view('details_product', compact([
            'product',
            'star1',
            'star2',
            'star3',
            'star4',
            'star5',
        ]));
    }

    public function getProductByCategory($slug)
    {
        $category = Category::with(
            [
                'childrenCategory' => function ($query) {
                    $query->with(['products' => function ($q) {
                        $q->with('productAttributes', 'productImages');
                    }]);
                },
                'products',
            ]
        )
            ->whereSlug($slug)
            ->firstOrFail();

        return view('category', compact('category'));
    }
}
