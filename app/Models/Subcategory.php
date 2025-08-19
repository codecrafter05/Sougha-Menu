<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    protected $fillable = [
        'category_id', 'slug', 'label_en', 'label_ar', 'sort_order', 'is_active',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Subcategory $model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->label_en, $model->category_id);
            }
        });

        static::updating(function (Subcategory $model) {
            if ($model->isDirty('label_en') && empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->label_en, $model->category_id);
            }
        });
    }

    protected static function generateUniqueSlug(string $source, int $categoryId): string
    {
        $base = Str::slug($source);
        $slug = $base;
        $i = 1;
        while (static::where('category_id', $categoryId)->where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }
        return $slug;
    }
}
