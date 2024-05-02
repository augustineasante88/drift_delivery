<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function getLocation(){
        return $this->belongsTo(Hostel::class,'location', 'id');
    }

    public function getUserInfo(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function getBikerInfo(){
        return $this->belongsTo(User::class,'assignee', 'id');
    }

    public function getCenterName(){
        return $this->belongsTo(FoodCentre::class,'food_center_id', 'id');
    }
}
