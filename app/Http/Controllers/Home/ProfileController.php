<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\HomeController;
use App\Repositories\Interfaces\UserContract;
use Illuminate\Support\Facades\Storage;

class ProfileController extends HomeController
{
    protected $user;

    public function __construct(UserContract $user)
    {
        $this->user = $user;
    }

    public function updateAvatar(Request $request)
    {
        $userId = Auth::user()->id;

        $path = Storage::disk('public')->put('avatars', $request->file('pic'));

        $this->user->updateById($userId, [
            'image' => $path;

        ]);

        return redirect()->route('home_profile');
    }
}
