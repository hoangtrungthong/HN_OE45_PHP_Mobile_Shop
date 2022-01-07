<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\UploadFileRequest;
use App\Http\Requests\Users\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function editPassword(User $user)
    {
        return view('user.updatePassword', compact('user'));
    }

    public function update(UserProfileRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('user.profile');
    }

    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        $user->update(
            [
                'password' => Hash::make($request->password),
            ]
        );

        return redirect()->route('user.profile');
    }

    public function changePicture(User $user)
    {
        return view('user.changePicture', compact('user'));
    }

    public function upload(UploadFileRequest $request)
    {
        $img = uploadFile('image', config('path.USER_UPLOAD_PATH'), $request, $request->image);

        auth()->user()->update(['image' => $img]);

        return redirect()->route('user.profile');
    }
}
