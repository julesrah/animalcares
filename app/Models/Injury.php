<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Injury extends Model
{
    use HasFactory;

    public $table = 'injuries';

    protected $guarded = ['id'];
    protected $fillable = ['description'];

    public function consultation()
    {
        return $this->belongsToMany(Consultation::class);
    }

    public function pet()
    {
        return $this->belongsTo('App\Models\Pets');
    }
}