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
use Illuminate\View\View;
use App\Models\UserRole;
use App\Models\Prop;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('_lvz.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Prop $prop): RedirectResponse
    {
        if (!(int) $prop->get_prop('app_register')) {
            return back()->withInput()->withErrors(['status' => 'Регистрация недоступна']);
        }

        $request->validate([
            'registerName' => ['required', 'string', 'max:255'],
            'registerEmail' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email'],
            'registerPassword' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->registerName,
            'email' => $request->registerEmail,
            'password' => Hash::make($request->registerPassword),
        ]);

        if ($user) {
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => 1
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect('/')->with(['status' => 'Запись успешно создана']);
    }
}
