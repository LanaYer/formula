<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';

    protected $fillable = [
        'date', 'time_start', 'time_end', 'box_id', 'car_num', 'car_id', 'card_id', 'description'
    ];
}
