<?php

namespace Tests\Unit\Http\Controllers;

use App\Contracts\Repositories\UserRepository;
use App\Http\Controllers\NotificationController;
use App\Models\User;
use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\DatabaseNotification;
use Mockery;
use Tests\TestCase;

class NotificationControllerTest extends TestCase
{
    public $userRepo;
    public $notificationController;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepo = Mockery::mock(UserRepository::class);
        $this->notificationController = new NotificationController(
            $this->userRepo,
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
        unset($this->notificationController);
    }

    public function testIndex()
    {
        $response = $this->notificationController->index();
        $this->assertEquals('admin.notifications', $response->getName());
    }

    public function testUpdateWhenNoRead()
    {
        $user = User::factory()->make();

        $notify = Mockery::mock(DatabaseNotification::class)->makePartial();
        $notify->read_at = null;
        $notify->data = ['order_id' => 1];

        $this->userRepo->shouldReceive('getCurrentNotifications')->andReturn($notify);
        $notify->shouldReceive('markAsRead')->andReturn(true);

        $response = $this->notificationController->update($user->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testUpdateWhenRead()
    {
        $user = User::factory()->make();

        $notify = Mockery::mock(DatabaseNotification::class)->makePartial();
        $notify->read_at = '2022-01-13 9:00:00';
        $notify->data = ['order_id' => 1];

        $this->userRepo->shouldReceive('getCurrentNotifications')->andReturn($notify);

        $response = $this->notificationController->update($user->id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }
}
