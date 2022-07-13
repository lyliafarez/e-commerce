<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'price',
        'stock',
        'ref',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
