<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class SortController extends Controller
{
    /**
     * Sort Employees by field.
     *
     * @param Request $request
     * @return mixed
     */
    public function sortBy(Request $request)
    {
        $field = $request->field;

        if (in_array($field, ['name', 'start_date', 'position', 'salary'])) {
            return Employee::orderBy($field)->get();
        }
            return response('Error field.', 422);
    }
}
