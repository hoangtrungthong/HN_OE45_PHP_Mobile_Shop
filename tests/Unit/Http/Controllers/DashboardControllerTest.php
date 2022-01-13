<?php

namespace Tests\Unit\Http\Controllers;

use App\Contracts\Repositories\OrderRepository;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Order;
use Carbon\Carbon;
use Mockery;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    public $chart;

    protected function setUp(): void
    {
        parent::setUp();
        $this->chart = new DashboardController();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->chart);
    }

    public function testDashboard()
    {
        $orderRepository = Mockery::mock(OrderRepository::class);
        $order = Mockery::mock(Order::class)->makePartial();
        $order->created_at = Carbon::parse('2022-01-13 9:00:00');
        $order->amount = 1000;

        $orderRepository->shouldReceive('whereYear->whereStatus->get->groupBy')
            ->with(
                Mockery::on(
                    function ($callback) use ($order) {
                        $order->shouldReceive('format')->andReturnSelf();

                        $callback->__invoke($order);

                        return is_callable($callback);
                    }
                )
            )->andReturnSelf();

        $orderRepository->shouldReceive('whereYear->whereStatus->get->groupBy->map')
            ->with(
                Mockery::on(
                    function ($callback) use ($order) {
                        $order->shouldReceive('pluck->toArray')->andReturn([$order->amount]);

                        $callback->__invoke($order);

                        return is_callable($callback);
                    }
                )
            )->andReturnSelf();

        $orderRepository->shouldReceive('whereYear->whereStatus->get->groupBy->map->toArray')
            ->andReturn([$order]);

        $response = $this->chart->dashboard($orderRepository);
        $this->assertEquals('admin.dashboard', $response->getName());
    }
}
