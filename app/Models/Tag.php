<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $guarded = [];


    protected static function booted(): void
    {
        static::creating(function(Tag $tag){
            $tag->slug = Str::slug($tag->name);
        });

        static::updating(function(Tag $tag){
            $tag->slug = Str::slug($tag->name);
        });
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
