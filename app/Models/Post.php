<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function(Post $post){
            $post->slug = Str::slug($post->title);
        });

        static::updating(function(Post $post){
            $post->slug = Str::slug($post->title);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id')->withDefalt();
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefalt([
            'name' => 'Uncategorized'
        ]);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getTagsIdsAttribute(){
        return $this->tags()->pluck('id')->toArray();
    }
}
