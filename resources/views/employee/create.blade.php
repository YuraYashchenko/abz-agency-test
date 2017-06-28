@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input name="name" type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label for="salary">Salary:</label>
                    <input type="text" name="salary" class="form-control">
                </div>

                <div class="form-group">
                    <label for="position">Position:</label>
                    <input type="text" name="position" class="form-control">
                </div>

                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" name="start_date" value="{{ date('Y-m-d') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="boss">Boss:</label>
                    <select name="boss_id" id="boss">
                        <option value="0">Make a Boss</option>
                        @foreach($employees as $e)
                            <option value="{{ $e->id }}">{{ $e->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="file">Choose Photo:</label>
                    <input type="file" id="file" name="avatar">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection