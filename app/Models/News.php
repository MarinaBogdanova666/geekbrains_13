<?php declare(strict_types=1);

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, Sluggable;

    public static $availableFields = ['id', 'title', 'slug', 'author', 'status', 'description', 'image', 'created_at'];
    protected $table = 'news';

    /**
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author',
        'status',
        'description',
        'image'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'display' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return \string[][]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
