<?php

namespace Tests\Unit\Notifications;

use App\Models\User;
use App\Notifications\OrderAdminNotification;
use Mockery;
use Tests\TestCase;

class OrderAdminNotificationTest extends TestCase
{
    public $notify;
    public $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [1];
        $this->notify = new OrderAdminNotification(
            $this->data,
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->data);
    }

    public function testVia()
    {
        $via = ['database'];
        $response = $this->notify->via($via);
        $this->assertEquals($response, ['database']);
    }

    public function testToArray()
    {
        $this->markTestSkipped();
        $notifiable = Mockery::mock(User::class)->makePartial();
        $notifiable->id = 1;

        $response = $this->notify->toArray($notifiable);
        $this->assertIsArray($response);
    }
}
