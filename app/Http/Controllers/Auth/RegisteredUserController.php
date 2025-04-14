<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\UserGenderEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationClientRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

final class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        $genders = UserGenderEnum::cases();

        return view('auth.register', ['genders' => $genders]);
    }

    public function registerClient(RegistrationClientRequest $request): RedirectResponse
    {
        $request->validated();

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => UserGenderEnum::from($request->gender),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole(UserRoleEnum::Client->value);
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('clients.home', absolute: false))->with('success', 'Registration Successful');
    }
}
