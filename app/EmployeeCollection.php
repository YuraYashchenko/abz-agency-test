<?php

namespace App;


use Illuminate\Database\Eloquent\Collection;

class EmployeeCollection extends Collection
{
    public function threaded()
    {
        $employees = parent::groupBy('boss_id');

        if (count($employees)) {
            $employees['boss'] = $employees[0];
            unset($employees[0]);
        }

        return $employees;
    }
}