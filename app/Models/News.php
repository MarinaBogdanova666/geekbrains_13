<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    public function getNews():array
    {
        return \DB::table($this->table)->select(['id', 'title', 'slug', 'author', 'status', 'description'])->get()->toArray();
    }

    public function getNewsById(int $id)
    {
        return  \DB::table($this->table)->find($id);
    }
}
