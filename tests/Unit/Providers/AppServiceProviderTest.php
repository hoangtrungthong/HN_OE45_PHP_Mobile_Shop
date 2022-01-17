<?php

namespace Tests\Unit\Providers;

use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\View;
use Mockery;
use Tests\TestCase;

class AppServiceProviderTest extends TestCase
{
    public $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new AppServiceProvider(Order::class);
    }

    public function testBoot()
    {
        $categoryRepo = Mockery::mock(CategoryRepository::class);
        $userRepo = Mockery::mock(UserRepository::class);

        $category = Mockery::mock(Category::class)->makePartial();
        $notify = Mockery::mock(DatabaseNotification::class)->makePartial();

        $categoryRepo->shouldReceive('whereParent->get')->andReturn($category);
        $userRepo->shouldReceive('getNotifications->sortByDesc')->andReturn($notify);
        $userRepo->shouldReceive('getNotifications->where')->andReturn($notify);
        View::shouldReceive('share')->andReturn();

        $response = $this->service->boot($categoryRepo, $userRepo);
        $this->assertNull($response);
    }
}
