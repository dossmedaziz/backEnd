<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = [
        'paper_file','paper_name', 'description', 'expiration_date',
        'auto_email','project_id','paper_type'
    ];



    public function paperType()
    {
        return $this->belongsTo(PaperType::class, 'paper_type');
    }
    public function project()
    {
        return $this->belongsTo(Project::class);

    }
}
