<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phim extends Model
{
    protected $table = 'phim';
    public function TheLoaiPhim(): BelongsTo
    {
        return $this->belongsTo(TheLoaiPhim::class, 'theloaiphim_id', 'id');
    }
    public function SuatChieu(): HasMany
    {
        return $this->hasMany(SuatChieu::class, 'phim_id', 'id');
    }
}
