<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';
    protected $fillable = [
        'total_ttc','ht_price', 'rate_tva', 'price_tva',
        'fiscal_timber','billNum','bill_file','DateFacturation',
       'description' , 'client_id'
    ];



    public function item()
    {
        return $this->hasMany(Item::class);
    }

}
