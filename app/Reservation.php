<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['current_id','owner_id','event_id','nop','status','title','start_date','end_date'];
}
