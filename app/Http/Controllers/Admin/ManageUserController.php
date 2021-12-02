<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', config('const.user'))->simplePaginate(config('const.pagination'));

        return view('admin.users.index', compact('users'));
    }

    public function blockUser(User $user)
    {
        $user->update([
            'is_block' => config('const.block'),
        ]);
        
        return redirect()->route('admin.manageUser');
    }

    public function activeUser(User $user)
    {
        $user->update([
            'is_block' => config('const.active'),
        ]);

        return redirect()->route('admin.manageUser');
    }
}
