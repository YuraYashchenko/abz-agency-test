<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function newCollection(array $models = [])
    {
        return new EmployeeCollection($models);
    }
}
