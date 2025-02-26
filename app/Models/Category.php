<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected static function booted(): void
    {
        static::creating(function(Category $category){
            $category->slug = Str::slug($category->name);
        });

        static::updating(function(Category $category){
            $category->slug = Str::slug($category->name);
        });
    }
}
