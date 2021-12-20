<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
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

            if ($cart[$slug . $key]['quantity'] > $attr->quantity) {
                return redirect()->back()->with('alert', __('common.fail_order'));
            }

            Session::put('cart', $cart);

            return redirect()->route('cart');
        }

        if (isset($cart[$slug . $key]) &&
            $cart[$slug . $key]['color'] === $request->color &&
            $cart[$slug . $key]['memory'] === $request->memory
        ) {
            if ($cart[$slug . $key]['quantity'] >= $attr->quantity) {
                return redirect()->back()->with('alert', __('common.fail_order'));
            }

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

            if ($cart[$slug . $key]['quantity'] > $attr->quantity) {
                return redirect()->back()->with('alert', __('common.fail_order'));
            }

            Session::put('cart', $cart);
        }

        return redirect()->route('cart');
    }

    public function update(Request $request)
    {
        $attr = ProductAttribute::where('product_id', $request->id)
            ->where('color_id', $request->color)
            ->where('memory_id', $request->memory)
            ->firstOrFail();

        if ($request->quantity < config('const.block') || $request->quantity > $attr->quantity) {
            return redirect()->back()->with('alert', __('common.fail_quantity'));
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
        $user = Auth::user();

        return view('user.checkout', compact('cart', 'user'));
    }
}
