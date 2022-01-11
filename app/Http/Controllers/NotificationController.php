<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('admin.notifications');
    }

    public function update($id)
    {
        $notify = $this->userRepository->getCurrentNotifications($id);

        if ($notify->read_at === null) {
            $notify->markAsRead();
        }

        return redirect()->route('admin.orderDetails', $notify->data['order_id']);
    }
}
