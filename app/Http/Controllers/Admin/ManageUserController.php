<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Models\User;

class ManageUserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository
            ->where('role_id', config('const.user'))
            ->simplePaginate(config('const.pagination'));

        return view('admin.users.index', compact('users'));
    }

    public function blockUser(User $user)
    {
        $user->update(
            [
                'is_block' => config('const.block'),
            ]
        );

        return redirect()->route('admin.manageUser');
    }

    public function activeUser(User $user)
    {
        $user->update(
            [
                'is_block' => config('const.active'),
            ]
        );

        return redirect()->route('admin.manageUser');
    }
}
