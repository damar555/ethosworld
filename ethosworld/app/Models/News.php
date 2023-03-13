<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = [];
    public $timestamps = false;
    protected function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
