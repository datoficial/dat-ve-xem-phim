<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuatChieu extends Model
{
    protected $table = 'suatchieu';
    public function PhongChieu(): BelongsTo
    {
        return $this->belongsTo(PhongChieu::class, 'phongchieu_id', 'id');
    }
    public function Phim(): BelongsTo
    {
        return $this->belongsTo(Phim::class, 'phim_id', 'id');
    }
    public function Ve(): HasMany
    {
        return $this->hasMany(Ve::class, 'suatchieu_id', 'id');
    }
}
