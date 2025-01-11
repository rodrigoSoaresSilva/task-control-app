<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task', 'deadline', 'user_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
