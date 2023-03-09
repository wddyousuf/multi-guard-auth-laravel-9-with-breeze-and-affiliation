<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionHistory extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function recharge()
    {
        return $this->hasOne(RechargeHistory::class,'id','recharge_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function affiliate()
    {
        return $this->hasOne(Affiliate::class,'id','affiliate_id');
    }
}
