<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['description','price','img_path'];

    public static $rulesss = [  
                    'description' =>'required',
                    'price'=>'required'];

    public function orders() {
        return $this->hasMany('App\Models\Order', 'customer_id');
    }
}