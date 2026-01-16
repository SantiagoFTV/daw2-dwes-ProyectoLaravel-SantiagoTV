<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bulo extends Model
{
    protected $fillable = [
        'user_id',
        'texto',
        'texto_desmentido'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
