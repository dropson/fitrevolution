<?php

declare(strict_types=1);

namespace App\Http\Controllers\Coach;

use App\Enums\ClientStatusEnum;
use App\Enums\UserGenderEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

final class ClientController extends Controller
{
    //
    public function createClient()
    {
        return view('coaches.clients.create');
    }

    public function storeClient(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'min:1', 'max:100'],
            'last_name' => ['required', 'string', 'min:1', 'max:100'],
            'gender' => ['required', Rule::enum(UserGenderEnum::class)],
        ]);

        $user = User::create($data);
        $user->assignRole(UserRoleEnum::Client->value);
        $client = $user->clientProfile()->create(['status' => ClientStatusEnum::Active->value]);
        $client->generateInvitationToken();

        $coach = Auth::user();
        $coach->clientsAsCoach()->attach($client->id);

        return to_route('coaches.home')->with('success', ' Client was crated');
    }
}
