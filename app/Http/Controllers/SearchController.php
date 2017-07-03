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

        $employees = Employee::search(
            $request->input('query')
        )->get();

        return $employees;
    }
}
