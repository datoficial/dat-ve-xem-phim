<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RapChieu extends Model
{
    protected $table = 'rapchieu';
    public function PhongChieu(): HasMany
    {
        return $this->hasMany(PhongChieu::class, 'rapchieu_id', 'id');
    }
}
