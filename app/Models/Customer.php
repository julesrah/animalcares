<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Customer extends Model implements Searchable 
{
    use HasFactory;
    use softDeletes;
    protected $guarded = ['id','img_path'];
    protected $fillable = ['title','lname','fname','addressline','town','zipcode','phone','img_path', 'user_id'];

	public function pets()
    {
        return $this->hasMany('App\Models\Pets','customer_id');
    }

	public function user() {
        return $this->belongsTo('App\Models\User');
    }      
    
     public function orders() {
        return $this->hasMany('App\Models\Order', 'customer_id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = $this->customer_id;
        return new SearchResult(
            $this,
            $this->fname.' '.$this->lname,
            $url
        );
    }
}