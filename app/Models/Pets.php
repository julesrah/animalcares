<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Pets extends Model implements Searchable
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['name','type','breed','img_path','customer_id'];

    public static $rulesss = [  
                    'name' =>'required',
                    'type'=>'required',
                    'breed'=>'required'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    public function consultation()
    {
        return $this->hasMany('App\Models\Consultation');
    }

 public function getSearchResult(): SearchResult
    {
        $url = $this->pet_id;
        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
    
}

