<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        DB::statement("SET SQL_MODE=''");
        $orders = DB::table('orders')
            ->select(
                'orders.id',
                'orders.phone',
                'orders.address',
                'orders.amount',
                'orders.created_at',
                'users.name',
                DB::raw('SUM(amount) as `sum_amount`')
            )
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->groupBy('user_id')
            ->paginate(config('const.pagination'));

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $orderDetails = OrderDetail::with(['order', 'product', 'color', 'memory'])->where('order_id', $id)->get();

        return view('admin.orders.details', compact('orderDetails'));
    }

    public function getOrderUser()
    {
        $user = Auth::user();
        $orders = Order::with('orderDetails')->where('user_id', $user->id)->paginate(config('const.pagination'));

        return view('user.history_order', compact('orders'));
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $cart = Session::get('cart');
            $amount = config('const.active');
            foreach ($cart as $key => $value) {
                $amount += $value['price'] * $value['quantity'];
            }

            $data = $request->only(['user_id', 'phone', 'address']);
            $data['amount'] = $amount;

            $order = Order::create($data);

            foreach ($cart as $key => $value) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $value['id'],
                    'color_id' => $value['color'],
                    'memory_id' => $value['memory'],
                    'price' => $value['price'],
                    'quantity' => $value['quantity'],
                    'image' => $value['image'],
                ]);
            }

            Session::forget('cart');

            DB::commit();

            return redirect()->route('home');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
        }
    }
}
