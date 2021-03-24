<?php

namespace App\Models;

use App\Http\Traits\HasSorts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, HasSorts;

    public $allowedSorts = [
        'title',
        'slug',
        'description',
        'status',
        'created_by'
    ];

    protected $fillable = [
        'uuid_task',
        'title',
        'slug',
        'description',
        'status',
        'created_by',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
