@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="img-circle" src="{{ Storage::url("avatars/{$employee->id}/avatar.jpeg") }}" alt="No Image">
            </div>

            <div class="col-md-8">
                <form action="{{ route('employee.update', $employee->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input name="name" type="text" class="form-control" value="{{ $employee->name }}">
                    </div>

                    <div class="form-group">
                        <label for="salary">Salary:</label>
                        <input type="text" name="salary" class="form-control" value="{{ $employee->salary }}">
                    </div>

                    <div class="form-group">
                        <label for="position">Position:</label>
                        <input type="text" name="position" class="form-control" value="{{ $employee->position }}">
                    </div>

                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-d', $employee->date) }}">
                    </div>

                    <div class="form-group">
                        <label for="boss">Boss:</label>
                        <select name="boss_id" id="boss">
                            @foreach($employees as $e)
                                <option {{ $employee->boss_id == $e->id ? 'selected' : '' }} value="{{ $e->id }}">{{ $e->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection