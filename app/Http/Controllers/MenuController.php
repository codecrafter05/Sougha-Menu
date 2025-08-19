<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function menu(): JsonResponse
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->with(['subcategories' => function ($q) {
                $q->where('is_active', true)->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get()
            ->map(function (Category $cat) {
                return [
                    'slug' => $cat->slug,
                    'label' => [
                        'en' => $cat->label_en,
                        'ar' => $cat->label_ar,
                    ],
                    'icon' => $cat->icon_path ? Storage::url($cat->icon_path) : null,
                    'subcategories' => $cat->subcategories->map(function ($sub) {
                        return [
                            'slug' => $sub->slug,
                            'label' => [
                                'en' => $sub->label_en,
                                'ar' => $sub->label_ar,
                            ],
                        ];
                    })->values()->all(),
                ];
            })->values()->all();

        $products = Product::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->with(['category', 'subcategory'])
            ->get()
            ->map(function (Product $p) {
                return [
                    'name' => [
                        'en' => $p->name_en,
                        'ar' => $p->name_ar,
                    ],
                    'price' => (float) $p->price,
                    'currency' => $p->currency,
                    'image' => $p->image_path ? Storage::url($p->image_path) : null,
                    'category' => optional($p->category)->slug,
                    'subcategory' => optional($p->subcategory)->slug,
                ];
            })->values()->all();

        return response()->json([
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}


