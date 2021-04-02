<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = [
        'paper_file','paper_name', 'description', 'start_date','end_date','isReminded',
        'auto_email','project_id','paper_type','status','alert_date'
    ];



    public function paperType()
    {
        return $this->belongsTo(PaperType::class, 'paper_type');
    }
    public function project()
    {
        return $this->belongsTo(Project::class);

    }


    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'alert_date' => 'datetime',
    ];




    public function type()
    {
        return $this->belongsTo(PaperType::class, 'paper_type')->where('is_renewing',1);
    }

  
}
