<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Activity extends Model
{
    protected $appends=['link'];
    public function salesmen(){
        return $this->belongsToMany(Salesman::class,'activity_salesmen');
    }

    public  function customers(){
        return $this->belongsToMany(Customer::class,'activity_customers');
    }

    public function getLinkAttribute(){
        return URL::to('/').'/activity/'.$this->id;
    }

    public function scopeRecently(Builder $builder){
        $latest = Carbon::now()->addDays(-7)->toDateString();
        return $builder->where('created_at','>',$latest);
    }
}
