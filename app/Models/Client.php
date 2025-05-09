<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClientStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

final class Client extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'invitation_token',
        'weight',
        'height',
        'goal',
    ];

    protected $casts = [
        'status' => ClientStatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function generateInvitationToken(): string
    {
        $this->invitation_token = Str::random(9);
        $this->save();

        return $this->invitation_token;
    }

    public function generateInvitationLink()
    {
        return url('join/'.$this->invitation_token);
    }
}
