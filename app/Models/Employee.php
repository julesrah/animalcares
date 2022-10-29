<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Mail\ContactMail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Authenticatable
{
    use HasFactory;
    public $remember_token = false;
    protected $guarded = ['id','img_path'];
    protected $fillable = ['title','lname','fname','addressline','town','zipcode','phone','role', 'img_path', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

        public function consultation()
    {
        return $this->hasMany('App\Models\Consultation');
    }

}
