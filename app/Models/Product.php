<?php

namespace App\Models;

use App\Http\Traits\HasSorts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasSorts;

    public $allowedSorts = [
        'name',
        'slug',
        'brand', 
        'price', 
        'market'    
    ];

    protected $fillable = [
        'name',
        'slug',
        'brand',
        'price',
        'market',
        'user_id' 
    ];


    /**
     * Return the post's author
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
