<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],// ユーザ名
            'name_kanji' => ['required', 'string', 'max:255'], // 漢字
            'name_kana' => ['required', 'string', 'max:255'],  // カナ
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],// Email
            'password' => ['required', 'confirmed', Rules\Password::defaults()], //Password
        ]);

        $user = User::create([
            'name' => $request->name,//ユーザ名
            'name_kanji' => $request->name_kanji, //漢字
            'name_kana' => $request->name_kana,   //カナ
            'email' => $request->email,//Email
            'password' => Hash::make($request->password),//Password
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
