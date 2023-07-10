<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['form' => 'Неверный логин или пароль'])->onlyInput('form', 'email');
        }

        $request->session()->regenerate();
        return redirect()->intended();
    }

    public function register(RegisterUserRequest $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|string',
            'password' => 'required|string|min:6'
        ]);

        User::create($credentials);
        Auth::attempt($credentials);

        return redirect()->intended();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function storeAvatar(Request $request)
    {
        $validator = $request->validate([
            'image' => ['required', File::image()]
        ]);

        $avatarFileName = $request->user()->id . '-avatar.' . $request->image->extension();
        $file = $request->image->move(public_path('images'), $avatarFileName);

        $user = $request->user();
        $user->avatar = $avatarFileName;
        $user->save();

        return back();
    }

    public function addTelegramToken(Request $request)
    {
        $validator = $request->validate([
            'token' => 'required'
        ]);

        // Get telegram user id
        $user_id = Str::before($request->token, ':');

        $user = $request->user();

        // Remove telegram token if exists
        $user->tokens()->where('name', 'tg-token')->delete();

        // Add new token
        if (!$user->addToken($request->token, 'tg-token')) {
            return back()->withErrors(['token' => 'Токен уже используется']);
        }
        $user->tg_user_id = $user_id;
        $user->save();

        return back();
    }

    public function revokeTelegramToken(Request $request)
    {
        $user = $request->user();
        $user->tokens()->where('name', 'tg-token')->delete();
        $user->tg_user_id = null;
        $user->save();
        return back();
    }
}
