<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Food extends Model
{
    use HasFactory;
    // use HasSlug;

    protected $fillable = [
        'name' ,
        'price' ,
        'food_category_id' ,
        'food_center_id' ,
        'image' ,
        'notes' ,
    ];

    //  /**
    //  * Get the options for generating the slug.
    //  */
    // public function getSlugOptions() : SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('name')
    //         ->saveSlugsTo('slug');
    // }

    public function getCategory(){
        return $this->belongsTo(FoodCategory::class,'food_category_id', 'id');
    }

    public function getCenter(){
        return $this->belongsTo(FoodCentre::class,'food_center_id', 'id');
    }
}
