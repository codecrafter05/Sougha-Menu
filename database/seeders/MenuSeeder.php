<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            ['label_en' => 'Hot Beverages', 'label_ar' => 'مشروبات حارة', 'icon_path' => 'categories/icons/hotdrink.png', 'sort_order' => 1],
            ['label_en' => 'Cakes', 'label_ar' => 'كيك', 'icon_path' => 'categories/icons/cake.png', 'sort_order' => 2],
            ['label_en' => 'Cold Beverages', 'label_ar' => 'مشروبات باردة', 'icon_path' => 'categories/icons/drink2.png', 'sort_order' => 3],
            ['label_en' => 'Bakery', 'label_ar' => 'مخبوزات', 'icon_path' => 'categories/icons/brade.png', 'sort_order' => 4],
            ['label_en' => 'Ice Cream', 'label_ar' => 'آيس كريم', 'icon_path' => 'categories/icons/11.png', 'sort_order' => 5],
        ])->map(fn ($c) => Category::updateOrCreate(['label_en' => $c['label_en']], $c));

        $catsByEn = $categories->keyBy('label_en');

        $subDefs = [
            ['cat' => 'Hot Beverages', 'label_en' => 'Coffee', 'label_ar' => 'القهوة الحارة', 'sort' => 1],
            ['cat' => 'Hot Beverages', 'label_en' => 'Tea', 'label_ar' => 'الشاي', 'sort' => 2],
            ['cat' => 'Hot Beverages', 'label_en' => 'Karak', 'label_ar' => 'الكرك', 'sort' => 3],
            ['cat' => 'Cakes', 'label_en' => 'Arabic Cake', 'label_ar' => 'كيك عربي', 'sort' => 1],
            ['cat' => 'Cakes', 'label_en' => 'Italian Cake', 'label_ar' => 'كيك إيطالي', 'sort' => 2],
            ['cat' => 'Cakes', 'label_en' => 'Popular Cake', 'label_ar' => 'كيك شعبي', 'sort' => 3],
            ['cat' => 'Cold Beverages', 'label_en' => 'Iced Coffee', 'label_ar' => 'قهوة باردة', 'sort' => 1],
            ['cat' => 'Cold Beverages', 'label_en' => 'Non-Coffee Iced', 'label_ar' => 'مشروبات باردة بلا قهوة', 'sort' => 2],
            ['cat' => 'Cold Beverages', 'label_en' => 'Juices', 'label_ar' => 'عصائر', 'sort' => 3],
            ['cat' => 'Cold Beverages', 'label_en' => 'Refreshers', 'label_ar' => 'منعشات', 'sort' => 4],
            ['cat' => 'Bakery', 'label_en' => 'Sandwiches', 'label_ar' => 'سندويجات', 'sort' => 1],
            ['cat' => 'Bakery', 'label_en' => 'Croissant', 'label_ar' => 'كرواسون', 'sort' => 2],
            ['cat' => 'Bakery', 'label_en' => 'Popular Sandwiches', 'label_ar' => 'سندويجات شعبية', 'sort' => 3],
            ['cat' => 'Ice Cream', 'label_en' => 'Affogato', 'label_ar' => 'أفوقاتو', 'sort' => 1],
        ];

        $subs = collect($subDefs)->map(function ($s) use ($catsByEn) {
            $cat = $catsByEn[$s['cat']];
            return Subcategory::updateOrCreate(
                ['category_id' => $cat->id, 'label_en' => $s['label_en']],
                ['category_id' => $cat->id, 'label_en' => $s['label_en'], 'label_ar' => $s['label_ar'], 'sort_order' => $s['sort']]
            );
        });

        $subsByCat = $subs->groupBy(fn ($s) => $s->category->label_en)->map(fn ($g) => $g->keyBy('label_en'));

        $products = [
            ['cat' => 'Hot Beverages', 'sub' => 'Coffee', 'en' => 'Double Espresso', 'ar' => 'اسبريسو مزدوج', 'price' => 25, 'img' => 'products/images/3.png', 'sort' => 1],
            ['cat' => 'Hot Beverages', 'sub' => 'Coffee', 'en' => 'Americano', 'ar' => 'أمريكانو', 'price' => 25, 'img' => 'products/images/3.png', 'sort' => 2],
            ['cat' => 'Hot Beverages', 'sub' => 'Coffee', 'en' => 'Latte', 'ar' => 'لاتيه', 'price' => 30, 'img' => 'products/images/4.png', 'sort' => 3],
            ['cat' => 'Hot Beverages', 'sub' => 'Coffee', 'en' => 'Cappuccino', 'ar' => 'كابتشينو', 'price' => 28, 'img' => 'products/images/4.png', 'sort' => 4],
            ['cat' => 'Hot Beverages', 'sub' => 'Coffee', 'en' => 'Spanish Latte', 'ar' => 'سبانيش لاتيه', 'price' => 35, 'img' => 'products/images/4.png', 'sort' => 5],
            ['cat' => 'Hot Beverages', 'sub' => 'Tea', 'en' => 'Black Tea', 'ar' => 'شاي أسود', 'price' => 12, 'img' => 'products/images/hotdrink.png', 'sort' => 1],
            ['cat' => 'Hot Beverages', 'sub' => 'Tea', 'en' => 'Green Tea', 'ar' => 'شاي أخضر', 'price' => 12, 'img' => 'products/images/hotdrink.png', 'sort' => 2],
            ['cat' => 'Hot Beverages', 'sub' => 'Karak', 'en' => 'Karak Tea', 'ar' => 'شاي كرك', 'price' => 14, 'img' => 'products/images/hotdrink.png', 'sort' => 1],
            ['cat' => 'Cakes', 'sub' => 'Arabic Cake', 'en' => 'Arabic Cake Slice', 'ar' => 'شريحة كيك عربي', 'price' => 18, 'img' => 'products/images/cake.png', 'sort' => 1],
            ['cat' => 'Cakes', 'sub' => 'Italian Cake', 'en' => 'Tiramisu', 'ar' => 'تيراميسو', 'price' => 24, 'img' => 'products/images/cake.png', 'sort' => 2],
            ['cat' => 'Cakes', 'sub' => 'Popular Cake', 'en' => 'Popular Cake', 'ar' => 'كيك شعبي', 'price' => 16, 'img' => 'products/images/cake.png', 'sort' => 3],
            ['cat' => 'Cold Beverages', 'sub' => 'Iced Coffee', 'en' => 'Iced Americano', 'ar' => 'امريكانو بارد', 'price' => 28, 'img' => 'products/images/1.png', 'sort' => 1],
            ['cat' => 'Cold Beverages', 'sub' => 'Iced Coffee', 'en' => 'Iced Latte', 'ar' => 'لاتيه بارد', 'price' => 30, 'img' => 'products/images/1.png', 'sort' => 2],
            ['cat' => 'Cold Beverages', 'sub' => 'Iced Coffee', 'en' => 'Iced Spanish', 'ar' => 'سبانيش بارد', 'price' => 38, 'img' => 'products/images/1.png', 'sort' => 3],
            ['cat' => 'Cold Beverages', 'sub' => 'Iced Coffee', 'en' => 'Iced White Mocha', 'ar' => 'وايت موكا بارد', 'price' => 42, 'img' => 'products/images/1.png', 'sort' => 4],
            ['cat' => 'Cold Beverages', 'sub' => 'Non-Coffee Iced', 'en' => 'Iced Matcha Latte', 'ar' => 'ماتشا لاتيه بارد', 'price' => 35, 'img' => 'products/images/2.png', 'sort' => 1],
            ['cat' => 'Cold Beverages', 'sub' => 'Non-Coffee Iced', 'en' => 'Iced Rose', 'ar' => 'وردي بارد', 'price' => 32, 'img' => 'products/images/1.png', 'sort' => 2],
            ['cat' => 'Cold Beverages', 'sub' => 'Non-Coffee Iced', 'en' => 'Mango Frappe', 'ar' => 'فرابيه مانجو', 'price' => 38, 'img' => 'products/images/2.png', 'sort' => 3],
            ['cat' => 'Cold Beverages', 'sub' => 'Juices', 'en' => 'Mango Juice', 'ar' => 'عصير مانجو', 'price' => 22, 'img' => 'products/images/2.png', 'sort' => 1],
            ['cat' => 'Cold Beverages', 'sub' => 'Juices', 'en' => 'Orange Juice', 'ar' => 'عصير برتقال', 'price' => 20, 'img' => 'products/images/1.png', 'sort' => 2],
            ['cat' => 'Cold Beverages', 'sub' => 'Refreshers', 'en' => 'Strawberry Mojito', 'ar' => 'موهيتو فراولة', 'price' => 35, 'img' => 'products/images/1.png', 'sort' => 1],
            ['cat' => 'Cold Beverages', 'sub' => 'Refreshers', 'en' => 'Passion Mojito', 'ar' => 'موهيتو باشن', 'price' => 35, 'img' => 'products/images/2.png', 'sort' => 2],
            ['cat' => 'Cold Beverages', 'sub' => 'Refreshers', 'en' => 'Lemon w/ Mint', 'ar' => 'ليمون نعنع', 'price' => 32, 'img' => 'products/images/1.png', 'sort' => 3],
            ['cat' => 'Cold Beverages', 'sub' => 'Refreshers', 'en' => 'Carcadet', 'ar' => 'كركديه', 'price' => 30, 'img' => 'products/images/2.png', 'sort' => 4],
            ['cat' => 'Bakery', 'sub' => 'Sandwiches', 'en' => 'Chicken Sandwich', 'ar' => 'ساندويش دجاج', 'price' => 26, 'img' => 'products/images/sandwich.png', 'sort' => 1],
            ['cat' => 'Bakery', 'sub' => 'Croissant', 'en' => 'Butter Croissant', 'ar' => 'كرواسون زبدة', 'price' => 12, 'img' => 'products/images/carwason.png', 'sort' => 2],
            ['cat' => 'Bakery', 'sub' => 'Popular Sandwiches', 'en' => 'Popular Sandwich', 'ar' => 'ساندويج شعبي', 'price' => 20, 'img' => 'products/images/brade.png', 'sort' => 3],
            ['cat' => 'Ice Cream', 'sub' => 'Affogato', 'en' => 'Classic Affogato', 'ar' => 'أفوقاتو كلاسيك', 'price' => 45, 'img' => 'products/images/11.png', 'sort' => 1],
            ['cat' => 'Ice Cream', 'sub' => 'Affogato', 'en' => 'Matcha Affogato', 'ar' => 'ماتشا أفوقاتو', 'price' => 48, 'img' => 'products/images/11.png', 'sort' => 2],
            ['cat' => 'Ice Cream', 'sub' => 'Affogato', 'en' => 'Lotus Affogato', 'ar' => 'لوتس أفوقاتو', 'price' => 50, 'img' => 'products/images/11.png', 'sort' => 3],
        ];

        foreach ($products as $p) {
            $cat = $catsByEn[$p['cat']];
            $sub = $subsByCat[$p['cat']][$p['sub']] ?? null;
            Product::updateOrCreate(
                ['name_en' => $p['en'], 'category_id' => $cat->id],
                [
                    'subcategory_id' => $sub?->id,
                    'name_en' => $p['en'],
                    'name_ar' => $p['ar'],
                    'price' => $p['price'],
                    'currency' => 'BHD',
                    'image_path' => $p['img'],
                    'sort_order' => $p['sort'],
                    'is_active' => true,
                ]
            );
        }
    }
}
