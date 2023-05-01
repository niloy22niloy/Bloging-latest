<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    function rel_to_guest(){
        return $this->belongsTo(GuestLogin::class,'guest_id');
    }
    
    function replies()
    {
        return $this->hasMany(ComentModel::class, 'parent_id');
    }
}
