<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $guarded = ['id'];
    public $fillable = ['petgrooming_id', 'guests','comment'];

    public function comments() {
        return $this->hasMany('App\Models\Comment', 'customer_id');
    }

     public function services() {
        return $this->belongsToMany('App\Models\Services', 'service_id');
    }
}