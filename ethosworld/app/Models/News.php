<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'news';
     protected $primarykey = 'id_news';
     public $timestamps = false;

    protected $guarded = [
    ];
}