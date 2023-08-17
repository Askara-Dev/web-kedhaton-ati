<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'content',
        'status',
        'user_id'
    ];

    // relation model tag
    public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    // relation model categories
    public function categories() {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function scopeSearch($query, $title) {
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    // scope
    public function scopePublish($query) {
        return $query->where('status', "publish");
    }

    // scope
    public function scopeDraft($query) {
        return $query->where('status', "draft");
    }

}
