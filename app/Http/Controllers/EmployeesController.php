<?php

namespace App\Http\Controllers;

use App\Employee;
use App\ImageUpload;
use Illuminate\Http\Request;
use Image;
use Storage;

class EmployeesController extends Controller
{
    /**
     * EmployeesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('name')->get();

        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();

        return view('employee.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:30',
            'salary' => 'required|numeric',
            'position' => 'required|min:2|max:30',
            'start_date' => 'required|date',
            'boss_id' => 'required|numeric',
            'avatar' => 'sometimes|image'
        ]);

        $employee = Employee::create($request->all());
        
        (new ImageUpload($request, $employee))->upload(400, 100);

        return redirect()->route('employee.show', $employee->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $employee->load('boss');
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $employees = Employee::all();

        return view('employee.edit', compact('employee', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:30',
            'salary' => 'required|numeric',
            'position' => 'required|min:2|max:30',
            'start_date' => 'required|date',
            'boss_id' => 'required|numeric|not_in:' . $employee->id
        ]);

        $employee->update($request->all());

        if (Storage::disk('local')->exists("public/avatars/{$employee->id}/avatar.jpeg"))
        {
            Storage::delete("public/avatars/{$employee->id}/avatar.jpeg");
        }
        (new ImageUpload($request, $employee))->upload(400, 100);

        return redirect()->route('employee.show', $employee->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $subordinates = $employee->subordinates;

        $subordinates->each->update([
            'boss_id' => $employee->boss->id
        ]);

        $employee->delete();
    }
}
