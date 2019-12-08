<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Itinerary extends Model
{
    public static function getName($user_id){
        $getName = User::select('name')->where('id',$user_id)->first();
        return $getName->name;
    }
}
