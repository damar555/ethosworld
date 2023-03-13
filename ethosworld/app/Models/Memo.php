<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'memos';

    protected $guarded = [
    ];
}