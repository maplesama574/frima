<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',      
        'image_path',
        'category',
        'condition',
        'name',    
        'brand',   
        'description',      
        'price',   
        'is_sold' 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function purchases()
    {
    return $this->hasMany(Purchase::class);
    }
public function categoriesArray()
{
    return explode(',', $this->category);
}

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    

}
