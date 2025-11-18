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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
