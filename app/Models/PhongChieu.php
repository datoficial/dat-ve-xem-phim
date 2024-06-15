<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhongChieu extends Model
{
    protected $table = 'phongchieu';
    public function RapChieu(): BelongsTo
    {
        return $this->belongsTo(RapChieu::class, 'rapchieu_id', 'id');
    }
    public function SuatChieu(): HasMany
    {
        return $this->hasMany(SuatChieu::class, 'phongchieu_id', 'id');
    }

}
