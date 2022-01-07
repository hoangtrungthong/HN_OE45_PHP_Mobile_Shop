<?php

namespace App\Providers;

use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(
        CategoryRepository $categoryRepository,
        UserRepository $userRepository
    ) {
        if (!app()->runningInConsole()) {
            $categories = $categoryRepository->whereParent(config('const.active'))->get();

            $notifications = $userRepository->getNotifications()->sortByDesc('created_at');

            $read = $userRepository->getNotifications()->where('read_at', null);

            $data = [
                'notifications' => $notifications,
                'read' => $read,
                'now' => Carbon::now(),
                'categories' => $categories,
            ];

            View::share('data', $data);
        }
    }
}
