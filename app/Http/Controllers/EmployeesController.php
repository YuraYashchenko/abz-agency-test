<?php

namespace App\Http\Controllers;

use App\Employee;
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
        
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $image = Image::make($file)
                ->resize(400, 100, function($constraint) {
                    $constraint->aspectRatio();
                });

            $imageSmall = Image::make($file)
                ->resize(50, 50, function ($constraint) {
                    $constraint->aspectRatio();
                });

            $image->stream();
            $imageSmall->stream();

            Storage::disk('local')->put("public/avatars/{$employee->id}/avatar.jpeg", $image);
            Storage::disk('local')->put("public/avatars/{$employee->id}/avatarSmall.jpeg", $image);
        }

        return redirect()->route('employee.edit', $employee->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Employee $employee)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     * @internal param int $id
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

        $employee->update([
            'name' => $request->name,
            'salary' => $request->salary,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'boss_id' => $request->boss_id
        ]);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
