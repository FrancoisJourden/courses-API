<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $table = "item";
    protected $fillable = [
        "name",
        "unit",
        "category"
    ];

    public function articles(): HasMany {
        return $this->hasMany(Article::class);
    }
}
