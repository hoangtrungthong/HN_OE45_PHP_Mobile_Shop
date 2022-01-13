<?php

namespace Tests\Unit\Events;

use App\Events\NotificationEvent;
use App\Models\Order;
use Illuminate\Broadcasting\PrivateChannel;
use Mockery;
use Tests\TestCase;

class NotificationsEventTest extends TestCase
{
    public $data;
    protected function setUp(): void
    {
        parent::setUp();
        $this->data = Mockery::mock(Order::class)->makePartial();
    }

    public function testBroadcastOn()
    {
        $event = new NotificationEvent($this->data);

        $response = $event->broadcastOn();
        $this->assertInstanceOf(PrivateChannel::class, $response);
    }
}
