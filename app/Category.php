<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = "categories";
    protected $guarded = [];

    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'category_name'
            ]
        ];
    }

    public function allProducts()
    {
        return $this->belongsToMany('App\Product','products','category_id');
    }
}
