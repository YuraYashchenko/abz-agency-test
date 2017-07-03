@extends('layouts.app')

@section('content')
    <div class="container">
        @if (isset($employees['boss']))
            <div class="row">
                @include('partials._list', ['collection' => $employees['boss']])
            </div>
        @else
            <h1>There is no main boss.</h1>
        @endif
    </div>
@endsection