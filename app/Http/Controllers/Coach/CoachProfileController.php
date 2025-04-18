<?php

declare(strict_types=1);

namespace App\Http\Controllers\Coach;

use App\Enums\CurrencyEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

final class CoachProfileController extends Controller
{
    public function updateInformation(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'bio' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['nullable', Rule::enum(CurrencyEnum::class)],
        ]);
        $user->coachProfile()->updateOrCreate(['user_id' => $user->id], $data);

        return to_route('profile.edit')->with('success', 'Your information  updated');
    }
}
