<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public $productRepository;
    public $categoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function changeLang(Request $request)
    {
        Session::put('language', $request->language);

        return redirect()->back();
    }

    public function index()
    {
        $products = $this->productRepository->orderBy('id', 'DESC')
            ->paginate(config('const.pagination'));

        $categories = $this->categoryRepository->with('childrenCategory')
            ->whereParent(config('const.active'))
            ->get();

        return view('home', compact('products', 'categories'));
    }

    public function showProduct($slug)
    {
        $product = $this->productRepository->with(
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

        return view(
            'details_product',
            compact(
                [
                    'product',
                    'star1',
                    'star2',
                    'star3',
                    'star4',
                    'star5',
                ]
            )
        );
    }

    public function getProductByCategory($slug)
    {
        $category = $this->categoryRepository->with(
            [
                'childrenCategory' => function ($query) {
                    $query->with(
                        ['products' => function ($q) {
                            $q->with('productAttributes', 'productImages');
                        }]
                    );
                },
                'products',
            ]
        )
            ->whereSlug($slug)
            ->firstOrFail();

        return view('category', compact('category'));
    }
}
