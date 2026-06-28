<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    protected $fillable = ['category', 'subcategory', 'title', 'description', 'image_path', 'icon', 'item_type'];

    public static function categories(): array
    {
        return ['mens', 'womens', 'kids'];
    }

    public static function subcategories(string $category): array
    {
        if ($category === 'mens') {
            return [
                'T-Shirts',
                'Polo Shirts',
                'Shirts (Casual/Formal)',
                'Punjabi / Panjabi',
                'Hoodies & Sweatshirts',
                'Jackets & Blazers',
                'Jeans',
                'Trousers & Chinos',
                'Shorts',
                'Sportswear',
                'Ethnic Wear',
                'Accessories (Belts, Caps, Wallets)',
            ];
        }

        if ($category === 'womens') {
            return [
                'Tops',
                'T-Shirts',
                'Kurtis',
                'Sarees',
                'Salwar Kameez',
                'Dresses',
                'Gowns',
                'Jeans',
                'Leggings',
                'Skirts',
                'Jackets & Shrugs',
                'Activewear',
                'Ethnic Wear',
                'Accessories (Bags, Scarves, Jewelry)',
            ];
        }

        return [
            'T-Shirts',
            'Shirts',
            'Frocks',
            'Dresses',
            'Punjabi',
            'Jeans',
            'Shorts',
            'Skirts',
            'School Wear',
            'Party Wear',
            'Winter Wear',
            'Baby Wear (0–2 Years)',
        ];
    }
}
