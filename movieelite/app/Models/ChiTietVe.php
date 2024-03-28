<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTietVe extends Model
{
    protected $table = 'chitietve';
    public function Ve(): BelongsTo
    {
        return $this->belongsTo(Ve::class, 've_id', 'id');
    }
}
