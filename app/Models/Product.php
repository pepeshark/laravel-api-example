<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 */
class Product extends Model
{
    use HasFactory;

    const PAGINATION = 10;

    protected $fillable = [
        'name', 'price', 'category_id'
    ];

    /**
     * Get the category.
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}
