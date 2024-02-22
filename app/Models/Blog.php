<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content','image','published_at','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Categorie::class,'blog_categorie')->withTimestamps();
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
