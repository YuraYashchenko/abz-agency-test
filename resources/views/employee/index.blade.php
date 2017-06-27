@extends('layouts.app')

@section('content')
    <div class="container">
        <Employees :data="{{ $employees }}"></Employees>
    </div>
@endsection