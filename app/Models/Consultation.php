<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{
    use HasFactory;

    public $table = 'consultation';
    public $timestamps = 'true';

    protected $guarded = ['id'];
    protected $fillable = ['pet_id','employee_id','comment','price'];

    public function pet()
    {
        return $this->belongsTo('App\Models\Pets');
    }

    public function injuries()
    {
        return $this->belongsToMany('App\Models\Injury', 'consultinfo');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }

}