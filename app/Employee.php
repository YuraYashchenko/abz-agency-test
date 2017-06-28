<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    protected $fillable = ['name', 'position', 'salary', 'start_date', 'boss_id'];

    public function newCollection(array $models = [])
    {
        return new EmployeeCollection($models);
    }

    public function scopeSearch($query, $q)
    {
        $query->where('name', 'like', $q)
            ->orWhere('position', 'like', $q)
            ->orWhere('start_date', 'like', $q)
            ->orWhere('salary', 'like', $q);
    }

    public function getStartDateAttribute($data)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $data)->format('j M Y');
    }

    public function setStartDateAttribute($date)
    {
        $this->attributes['start_date'] = Carbon::parse($date);
    }
}
