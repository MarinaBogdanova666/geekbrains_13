<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static $availableFields = ['id', 'title', 'description', 'created_at'];
    protected $table = 'categories';

    protected $fillable = [
        'title',
        'description'
    ];

    public function news(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(News::class, 'category_id', 'id');
    }
}

