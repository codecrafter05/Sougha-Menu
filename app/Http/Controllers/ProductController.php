<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the main menu page with categories and products
     */
    public function index(): View
    {
        // Get categories with subcategories
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

        // Get all active products
        $products = Product::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->with(['category', 'subcategory'])
            ->get()
            ->map(function (Product $p) {
                return [
                    'id' => $p->id,
                    'name' => [
                        'en' => $p->name_en,
                        'ar' => $p->name_ar,
                    ],
                    'price' => (float) $p->price,
                    'price_two' => $p->price_two ? (float) $p->price_two : null,
                    'price_three' => $p->price_three ? (float) $p->price_three : null,
                    'currency' => $p->currency,
                    'image' => $p->image_path ? Storage::url($p->image_path) : null,
                    'category' => optional($p->category)->slug,
                    'subcategory' => optional($p->subcategory)->slug,
                ];
            })->values()->all();

        // Add "All" category at the beginning
        $allCategory = [
            'slug' => 'all',
            'label' => [
                'en' => 'All',
                'ar' => 'الكل'
            ],
            'icon' => asset('images/allicon.png'),
            'subcategories' => []
        ];

        $categories = collect([$allCategory])->concat($categories)->toArray();

        return view('index', compact('categories', 'products'));
    }

    /**
     * Display products by category
     */
    public function category(string $slug): View
    {
        // Get categories for navigation
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

        // Add "All" category
        $allCategory = [
            'slug' => 'all',
            'label' => [
                'en' => 'All',
                'ar' => 'الكل'
            ],
            'icon' => asset('images/allicon.png'),
            'subcategories' => []
        ];

        $categories = collect([$allCategory])->concat($categories)->toArray();

        // Get products for specific category
        $query = Product::query()
            ->where('is_active', true)
            ->with(['category', 'subcategory']);

        if ($slug !== 'all') {
            $query->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }

        $products = $query->orderBy('sort_order')->get()
            ->map(function (Product $p) {
                return [
                    'id' => $p->id,
                    'name' => [
                        'en' => $p->name_en,
                        'ar' => $p->name_ar,
                    ],
                    'price' => (float) $p->price,
                    'price_two' => $p->price_two ? (float) $p->price_two : null,
                    'price_three' => $p->price_three ? (float) $p->price_three : null,
                    'currency' => $p->currency,
                    'image' => $p->image_path ? Storage::url($p->image_path) : null,
                    'category' => optional($p->category)->slug,
                    'subcategory' => optional($p->subcategory)->slug,
                ];
            })->values()->all();

        $currentCategory = $slug === 'all' ? null : collect($categories)->firstWhere('slug', $slug);

        return view('index', compact('categories', 'products', 'currentCategory'));
    }

    /**
     * Display a single product
     */
    public function show(string $slug): View
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'subcategory'])
            ->firstOrFail();

        $productData = [
            'id' => $product->id,
            'name' => [
                'en' => $product->name_en,
                'ar' => $product->name_ar,
            ],
            'description' => [
                'en' => $product->description_en,
                'ar' => $product->description_ar,
            ],
            'price' => (float) $product->price,
            'price_two' => $product->price_two ? (float) $product->price_two : null,
            'price_three' => $product->price_three ? (float) $product->price_three : null,
            'currency' => $product->currency,
            'image' => $product->image_path ? Storage::url($product->image_path) : null,
            'category' => optional($product->category)->slug,
            'subcategory' => optional($product->subcategory)->slug,
        ];

        return view('product', compact('productData'));
    }
}
