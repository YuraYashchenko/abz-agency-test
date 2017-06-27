@extends('layouts.app')

@section('content')
    <div class="container">
        <Employees :employees="{{ $employees }}"></Employees>
    </div>
@endsection