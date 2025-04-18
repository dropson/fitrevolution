<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class ClientProfileController extends Controller
{
    public function updateInformation(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'goal' => ['nullable', 'string'],
            'weight' => ['nullable', 'string'],
            'height' => ['nullable', 'string'],
        ]);
        $user->clientProfile()->updateOrCreate(['user_id' => $user->id], $data);

        return to_route('profile.edit')->with('success', 'Your information  updated');
    }
}
