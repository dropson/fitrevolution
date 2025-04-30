<?php

declare(strict_types=1);

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

final class HomeController extends Controller
{
    public function index()
    {
        $coach = Auth::user();
        $coach->load([
            'clientsAsCoach' => function ($query): void {
                $query->latest('users.created_at');
            },
            'clientsAsCoach.clientProfile',
        ]);

        return view('coaches.home', ['coach' => $coach]);
    }
}
