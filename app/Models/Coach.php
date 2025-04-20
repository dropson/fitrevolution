<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CurrencyEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Coach extends Model
{
    protected $fillable = [
        'bio',
        'price',
        'currency',
    ];

    protected $casts = [
        'currency' => CurrencyEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
