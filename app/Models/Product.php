<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        parent::booted();
        static::observe(ProductObserver::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
