@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="img" src="{{ Storage::url("avatars/{$employee->id}/avatar.jpeg") }}" alt="No Image">
            </div>

            <div class="col-md-8">
                <label for="name">Name:</label>
                <h4 id="name"> {{ $employee->name }}</h4>

                <label for="salary">Salary:</label>
                <h4 id="salary"> {{ $employee->salary }}</h4>

                <label for="position">Position:</label>
                <h4 id="position"> {{ $employee->position }}</h4>

                <label for="date">Date:</label>
                <h4 id="date"> {{ $employee->start_date }}</h4>

                <label for="boss">Boss:</label>
                <h4 id="boss">{{ $employee->boss->name ?? '-' }}</h4>

                <a class="btn btn-success" href="{{ route('employee.edit', $employee->id) }}">Edit</a>
                <button class="btn btn-danger" @click="destroy({{ $employee->id }})">Delete</button>
            </div>
        </div>
    </div>
@endsection