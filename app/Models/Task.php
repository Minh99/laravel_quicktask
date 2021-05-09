<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function members()
    {
        return $this->belongsToMany('App\Models\Member','plans')->withTimestamps();;
    }

}
