<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TheLoaiPhim extends Model
{
    protected $table = 'theloaiphim';
    public function Phim(): HasMany
    {
        return $this->hasMany(Phim::class, 'theloaiphim_id', 'id');
    }
}
