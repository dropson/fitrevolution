<?php

declare(strict_types=1);

namespace App\Http\Controllers\Coach;

use App\Enums\ClientStatusEnum;
use App\Enums\UserGenderEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Notifications\InviteClientNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $coach->clientsAsCoach()->attach($user->id);

        return to_route('coaches.home')->with('success', ' Client was crated');
    }
    public function showClient(User $client)
    {
        return view('coaches.clients.index', [
            'client' => $client
        ]);
    }
    public function showJoinForm($token)
    {
        $client = Client::where('invitation_token', $token)->firstOrFail();

        return view('auth.join', ['client' => $client]);
    }

    public function storeClinetByToken(Request $request, $token)
    {
        $client = Client::where('invitation_token', $token)->firstOrFail();
        $user = $client->user;

        $request->validate([
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $client->update(['invitation_token' => null]);

        return redirect()->route('login')
            ->with('success', 'Registration was successful.');
    }

    public function sendInvitation(Request $request)
    {
        $client = User::where('id', $request->client_id)->firstOrFail();
        if (!auth()->user()->clientsAsCoach->contains($client->id)) {
            abort(403, 'No poermission');
        }

        $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
        ]);

        $client->update([
            'email' => $request->email,
        ]);

        $client->notify(new InviteClientNotification($client));

        return redirect()->route('coaches.home')
            ->with('success', 'Invitation sent.');
    }
}
