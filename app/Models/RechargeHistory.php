<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechargeHistory extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function commission()
    {
        return $this->hasMany(CommissionHistory::class,'recharge_id','id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
