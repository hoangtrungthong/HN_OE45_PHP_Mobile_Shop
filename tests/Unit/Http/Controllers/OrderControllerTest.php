<?php

namespace Tests\Unit\Http\Controllers;

use App\Contracts\Repositories\OrderDetailRepository;
use App\Contracts\Repositories\OrderRepository;
use App\Contracts\Repositories\UserRepository;
use App\Http\Controllers\OrderController;
use App\Http\Requests\Order\StoreRequest;
use App\Mail\OrderUser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use DB;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Mockery as m;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SessionHandler;

class OrderControllerTest extends TestCase
{
    public $orderController;
    public $orderRepository;
    public $orderDetailRepository;
    public $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderRepository = m::mock(OrderRepository::class);
        $this->orderDetailRepository = m::mock(OrderDetailRepository::class);
        $this->userRepository = m::mock(UserRepository::class);

        $this->orderController = new OrderController(
            $this->orderRepository,
            $this->orderDetailRepository,
            $this->userRepository,
        );
    }

    public function tearDown(): void
    {
        m::close();
        unset($this->orderController);
        parent::tearDown();
    }

    public function testIndex()
    {
        $order = Order::factory()->make();

        $this->orderRepository->shouldReceive('getAllOrders')->andReturn($order);

        $response = $this->orderController->index();
        $this->assertEquals('admin.orders.index', $response->getName());
    }

    public function testShow()
    {
        $order = Order::factory()->make();
        $order->id = 1;

        $orderDetails = m::mock(OrderDetail::class)->makePartial();

        $this->orderDetailRepository->shouldReceive('showDetailsOrders')->andReturn($orderDetails);

        $response = $this->orderController->show($order->id);
        $this->assertEquals('admin.orders.details', $response->getName());
    }

    public function testGetOrderPending()
    {
        $order = Order::factory()->make();

        $this->orderRepository->shouldReceive('getAllOrderPending')->andReturn($order);

        $response = $this->orderController->getOrderPending();
        $this->assertEquals('user.orders', $response->getName());
    }

    public function testGetOrderUser()
    {
        $order = Order::factory()->make();

        $this->orderRepository->shouldReceive('getOrderUserApprove')->andReturn($order);

        $response = $this->orderController->getOrderUser();
        $this->assertEquals('user.history_order', $response->getName());
    }

    public function testStoreCreateOrderSuccess()
    {
        Notification::fake();

        DB::shouldReceive('beginTransaction');
        Session::shouldReceive('get')->andReturn(
            [
            0 => [
                'id' => 1,
                'color' => 2,
                'memory' => 3,
                'price' => 5,
                'quantity' => 10,
                'image' => ''
            ]
            ]
        );
        Config::set('const.active', 0);

        $request = new StoreRequest(
            [
                'user_id' =>1,
                'phone' => '0987654321',
                'address' => 'abc',
                'amount' => 10000,
                'status' => 0,
                'order_id' => 1,
                'product_id' => [0 => 1],
                'color_id' => [0 => 2],
                'memory_id' => [0 => 3],
                'price' => [0 => 5],
                'quantity' => [0 => 10],
                'image' =>  [UploadedFile::fake()->image('file.png')],
            ]
        );

        Session::shouldReceive('driver')->andReturn(
            new Store('test', new SessionHandler)
        );

        $order = Order::factory()->make();

        $user = User::factory()->make();

        $order->setRelation('user', $user);

        $this->orderRepository->shouldReceive('create')->andReturn($order);
        $this->orderDetailRepository->shouldReceive('create')->andReturn();

        Session::shouldReceive('forget');

        $this->userRepository->shouldReceive('findAdmin')->andReturn($user);

        DB::shouldReceive('commit');

        $response = $this->orderController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testStoreCreateOrderFalse()
    {
        DB::shouldReceive('beginTransaction');
        Session::shouldReceive('get')->andReturn();
        Config::set('const.active', 0);

        $request = new StoreRequest(
            [
                'user_id' =>1,
                'phone' => '0987654321',
                'address' => 'abc',
                'amount' => 10000,
                'status' => 0,
            ]
        );

        $this->orderRepository->shouldReceive('create')->andReturn(false);
        DB::shouldReceive('rollBack');
        $response = $this->orderController->store($request);
        $this->assertNull($response);
    }

    public function testStateOrder()
    {
        DB::shouldReceive('beginTransaction');

        Mail::fake();

        $order = Order::factory()->make();
        $order->id = 1;

        $orderDetails = m::mock(OrderDetail::class)->makePartial();
        $orderDetails->id = 1;
        $orderDetails->color_id = 1;
        $orderDetails->memory_id = 1;
        $orderDetails->quantity = 1;

        $product = m::mock(Product::class)->makePartial();
        $product->id = 1;

        $user = User::factory()->make();

        $productAttributes = m::mock(ProductAttribute::class)->makePartial();
        $productAttributes->id = 1;
        $productAttributes->quantity = 2;

        $order->setRelation('user', $user);

        $this->orderRepository->shouldReceive('findOrFail')->andReturn($order);
        $this->orderDetailRepository->shouldReceive('showDetailsOrders')->andReturn([$orderDetails]);

        $orderDetails->setRelation('product', $product);
        $product->setRelation('productAttributes', $productAttributes);
        $productAttributes->shouldReceive('where->where->firstOrFail')->andReturn($productAttributes);

        $productAttributes->shouldReceive('update')->andReturn(true);

        $this->orderRepository->shouldReceive('whereId->update')->andReturn(true);

        DB::shouldReceive('commit');

        $response = $this->orderController->state($order->id);
        Mail::assertSent(OrderUser::class);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testStateOrderFalse()
    {
        DB::shouldReceive('beginTransaction');

        $order = Order::factory()->make();
        $order->id = 1;

        $orderDetails = m::mock(OrderDetail::class)->makePartial();
        $orderDetails->id = 1;
        $orderDetails->color_id = 1;
        $orderDetails->memory_id = 1;
        $orderDetails->quantity = 2;

        $product = m::mock(Product::class)->makePartial();
        $product->id = 1;

        $productAttributes = m::mock(ProductAttribute::class)->makePartial();
        $productAttributes->id = 1;
        $productAttributes->quantity = 1;

        $this->orderRepository->shouldReceive('findOrFail')->andReturn($order);
        $this->orderDetailRepository->shouldReceive('showDetailsOrders')->andReturn([$orderDetails]);

        $orderDetails->setRelation('product', $product);
        $product->setRelation('productAttributes', $productAttributes);
        $productAttributes->shouldReceive('where->where->firstOrFail')->andReturn($productAttributes);

        DB::shouldReceive('rollback');
        Log::shouldReceive('error');

        $response = $this->orderController->state($order->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testStateOrderException()
    {
        DB::shouldReceive('beginTransaction');

        $order = Order::factory()->make();
        $order->id = 1;

        $this->orderRepository->shouldReceive('findOrFail')->andThrow(new Exception());

        DB::shouldReceive('rollback');
        Log::shouldReceive('error');

        $response = $this->orderController->state($order->id);
        $this->assertNull($response);
    }

    public function testRejectOrder()
    {
        $id = 1;
        $order = Order::factory()->make();

        $this->orderRepository->shouldReceive('whereId->update')->andReturn($order);

        $response = $this->orderController->rejectOrder($id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testDestroySuccess()
    {
        DB::shouldReceive('beginTransaction');

        $order = m::mock(Order::class)->makePartial();

        $order->shouldReceive('delete')->andReturn();
        $order->shouldReceive('orderDetails->delete')->andReturn();

        DB::shouldReceive('commit');

        $response = $this->orderController->destroy($order);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testDestroyFalse()
    {
        DB::shouldReceive('beginTransaction');

        $order = m::mock(Order::class)->makePartial();

        $order->shouldReceive('delete')->andThrow(new Exception());

        DB::shouldReceive('rollback');
        Log::shouldReceive('error');

        $response = $this->orderController->destroy($order);
        $this->assertNull($response);
    }
}
