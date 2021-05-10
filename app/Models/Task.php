<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class Task extends Model
{
    use HasFactory;

    public function members()
    {
        return $this->belongsToMany(Member::class,'plans')->withTimestamps();;
    }

}
