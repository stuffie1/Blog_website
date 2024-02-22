<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
class BlogCategorie extends Model
{
    protected $table = 'blog_categorie';
    protected $fillable = ['blog_id', 'categorie_id'];

    
}