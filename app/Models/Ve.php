<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ve extends Model
{
    protected $table = 've';
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function SuatChieu(): BelongsTo
    {
        return $this->belongsTo(SuatChieu::class, 'suatchieu_id', 'id');
    }
}
