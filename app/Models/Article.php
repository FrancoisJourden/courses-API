<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model {
    protected $table = "article";

    protected $fillable = [
        'quantity'
    ];

    public function item(): BelongsTo {
        return $this->belongsTo(Item::class);
    }

    public function commission(): BelongsTo {
        return $this->belongsTo(Commission::class);
    }
}
