<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchByQuery(Request $request)
    {
        $this->validate($request, [
            'query' => 'required'
        ]);

        $q = '%' . $request->input('query') . '%';

        $employees = Employee::search($q)->get();

        return $employees;
    }
}
