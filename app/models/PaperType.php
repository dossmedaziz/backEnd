<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PaperType extends Model
{
    protected $fillable = [
        'paper_name', 'paper_type', 'email_id'
    ];
}
