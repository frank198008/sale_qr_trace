<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['salesman_id','name','phone','sex','occupation','id_number'];
    public function register(){
        return $this->belongsTo(Salesman::class,'salesman_id','id');
    }

    public function scopeRecently(Builder $builder){
        $latest = Carbon::now()->addDays(-7)->toDateString();
        return $builder->where('created_at','>',$latest);
    }
}
