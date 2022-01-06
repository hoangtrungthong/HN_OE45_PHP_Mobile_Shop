<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreRequest;
use App\Mail\OrderUser;
use App\Models\Order;
use App\Models\OrderDetail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('id', 'desc')->paginate(config('const.pagination'));

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $orderDetails = OrderDetail::with(['order', 'product', 'color', 'memory'])->where('order_id', $id)->get();

        return view('admin.orders.details', compact('orderDetails'));
    }

    public function getOrderPending()
    {
        $user = Auth::user();
        $orders = Order::with('orderDetails')
            ->where('user_id', $user->id)
            ->where('status', '!=', config('const.approve'))
            ->paginate(config('const.pagination'));

        return view('user.orders', compact('orders'));
    }

    public function getOrderUser()
    {
        $user = Auth::user();
        $orders = Order::with('orderDetails')
            ->where('user_id', $user->id)
            ->where('status', config('const.approve'))
            ->paginate(config('const.pagination'));

        return view('user.history_order', compact('orders'));
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $cart = Session::get('cart');
            $amount = config('const.active');
            foreach ($cart as $value) {
                $amount += $value['price'] * $value['quantity'];
            }

            $data = $request->only(['user_id', 'phone', 'address']);
            $data['amount'] = $amount;
            $data['status'] = config('const.pending');

            $order = Order::create($data);

            foreach ($cart as $value) {
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

    public function state($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            $orderDetails = OrderDetail::with(['order', 'product', 'color', 'memory'])
                ->where('order_id', $id)
                ->get();

            foreach ($orderDetails as $item) {
                $productAttr = $item->product->productAttributes
                    ->where('color_id', $item->color_id)
                    ->where('memory_id', $item->memory_id)
                    ->firstOrFail();

                if ($item->quantity > $productAttr->quantity) {
                    return redirect()->route('admin.orders.index')->with('alert', __('common.fail_quantity'));
                }

                $remaining = $productAttr->quantity - $item->quantity;
                $productAttr->update([
                    'quantity' => $remaining,
                ]);
            }

            Order::whereId($id)->update([
                'status' => config('const.approve'),
            ]);

            //send mail to user after admin approve order
            Mail::to($order->user->email)
                ->send(new OrderUser($order));

            DB::commit();

            return redirect()->route('admin.orders.index');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex);
        }
    }

    public function rejectOrder($id)
    {
        Order::whereId($id)->update([
            'status' => config('const.reject'),
        ]);

        return redirect()->route('admin.orders.index');
    }

    public function destroy(Order $order)
    {
        try {
            DB::beginTransaction();

            $order->delete();
            $order->orderDetails()->delete();

            DB::commit();

            return redirect()->back();
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex);
        }
    }
}
