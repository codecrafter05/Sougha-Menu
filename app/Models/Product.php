<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_id', 'name_en', 'name_ar', 'price', 'price_two', 'price_three', 'currency', 'image_path', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:3',
        'price_two' => 'decimal:3',
        'price_three' => 'decimal:3',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }
}
