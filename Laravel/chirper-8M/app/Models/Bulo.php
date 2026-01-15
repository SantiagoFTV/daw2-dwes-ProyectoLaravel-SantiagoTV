<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bulo extends Model
{
    protected $fillable = [
        'texto_bulo',
        'texto_desmentido',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
