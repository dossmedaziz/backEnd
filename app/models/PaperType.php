<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PaperType extends Model
{
    protected $fillable = [
         'paper_type', 'email_id'
    ];



    public function paper()
    {
        return $this->hasMany(Paper::class ,'paper_type');
    }
}
