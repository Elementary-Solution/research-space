<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'status',
        'no_of_pages',
        'subscription_duration',
        // 'regular_price',
        // 'discount_price',
        // 'stock',
        'image',

 'duration_type',
 'minimum_pages_allowed',
 'maximum_pages_allowed',
 'actual_price_per_page',
 'compare_price_per_page',
        'actual_price',
        'compare_price',
 'meta_title',
 'meta_description',
 'meta_keywords',
 'permission'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($product) {
            $product->slug = $product->createSlug($product->title);
            $product->save();
        });
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    private function createSlug($title){
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::whereTitle($title)->latest('id')->skip(1)->value('slug');

            if (is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }

            return "{$slug}-2";
        }

        return $slug;
    }

}
