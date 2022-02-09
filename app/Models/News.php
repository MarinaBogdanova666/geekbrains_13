<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder;

class News extends Model
{
    use HasFactory;


    public static $availableFields = ['id', 'title', 'slug', 'author', 'status', 'description', 'created_at'];
    protected $table = 'news';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author',
        'status',
        'description'
    ];

//    protected $guarded = [
//        'id'
//    ];

    protected $casts = [
        'display' => 'boolean'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
