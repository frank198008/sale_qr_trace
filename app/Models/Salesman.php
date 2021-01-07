<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    public function scopeAvailable(Builder $builder,$mobile){
        return $builder->where('phone',$mobile)->where('status',1);
    }
    public function activities(){
        return $this->belongsToMany(Activity::class,'activity_salesmen')->where('status',1);
    }

    public function scopeRecently(Builder $builder){
        $latest = Carbon::now()->addDays(-7)->toDateString();
        return $builder->where('created_at','>',$latest);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function getAttributeHasRegister(){

    }
}
