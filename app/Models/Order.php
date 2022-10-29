<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Item;

class Order extends Model
{
    protected $table = 'orderinfo';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_id', 'status'];
    
    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }

    public function services() {
        return $this->belongsToMany(Services::class,'orderline','orderinfo_id','service_id');
    }
}