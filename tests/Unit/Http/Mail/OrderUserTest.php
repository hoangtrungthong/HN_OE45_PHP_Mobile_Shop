<?php

namespace Tests\Unit\Http\Mail;

use App\Mail\OrderUser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Mockery;
use Tests\TestCase;

class OrderUserTest extends TestCase
{
    public $order;
    public $orderUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->order = Mockery::mock(Order::class)->makePartial();
        $this->orderUser = new OrderUser(
            $this->order,
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
        unset($this->orderUser);
    }

    public function testBuild()
    {
        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 1;

        $orderDetails = Mockery::mock(OrderDetail::class)->makePartial();
        $orderDetails->id =1;

        $this->order->setRelation('user', $user);
        $this->order->setRelation('orderDetails', $orderDetails);

        $response = $this->orderUser->build();
        $this->assertInstanceOf(OrderUser::class, $response);
    }
}
