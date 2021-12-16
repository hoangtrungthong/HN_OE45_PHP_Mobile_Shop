<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        return view('user.cart');
    }

    public function add(Request $request, $slug)
    {
        $user = Auth::user();
        $product = Product::with(['productAttributes', 'productImages'])->whereSlug($slug)->firstOrFail();
        $attr = $product->productAttributes()
            ->with(['colors', 'memories'])
            ->where('color_id', $request->color)
            ->where('memory_id', $request->memory)
            ->firstOrFail();

        $cart = Session::get('cart');
        $key = '-' . $attr->colors[0]->name . '-' . strtolower($attr->memories[0]->rom);
        if (!$cart) {
            $cart[$slug . $key] = [
                'id' => $product->id,
                'name' => $product->name . $key,
                'price' => $attr->price,
                'color' => $attr->color_id,
                'memory' => $attr->memory_id,
                'quantity' => 1,
                'image' => $product->productImages[0]->path,
            ];
            Session::put('cart', $cart);
            return redirect()->route('cart');
        }

        if (isset($cart[$slug . $key]) &&
            $cart[$slug . $key]['color'] === $request->color &&
            $cart[$slug . $key]['memory'] === $request->memory
        ) {
            $cart[$slug . $key]['quantity']++;
            Session::put('cart', $cart);

            return redirect()->route('cart');
        } else {
            $cart[$slug . $key] = [
                'id' => $product->id,
                'name' => $product->name . $key,
                'price' => $attr->price,
                'color' => $attr->color_id,
                'memory' => $attr->memory_id,
                'quantity' => 1,
                'image' => $product->productImages[0]->path,
            ];

            Session::put('cart', $cart);
        }

        return redirect()->route('cart');
    }

    public function update(Request $request)
    {
        if ($request->quantity < config('const.block')) {
            return redirect()->back();
        }
        if ($request->slug && $request->quantity) {
            $slug = Str::slug($request->slug);
            $cart = Session::get('cart');

            if (isset($cart[$slug])) {
                $cart[$slug]['quantity'] = $request->quantity;

                Session::put('cart', $cart);
            }

            return redirect()->back();
        }
    }

    public function remove(Request $request)
    {
        if ($request->slug) {
            $slug = Str::slug($request->slug);
            $cart = Session::get('cart');

            if (isset($cart[$slug])) {
                unset($cart[$slug]);

                Session::put('cart', $cart);
            }
        }
    }

    public function checkout()
    {
        $cart = Session::get('cart');

        return view('user.checkout', compact('cart'));
    }
}