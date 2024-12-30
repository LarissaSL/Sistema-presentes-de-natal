@extends('layouts.main_layout')

@include('layouts.nav_layout')

@section('content')
    <h1>Dashboard</h1>

    @if ($errors->any())
        <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
                <div class="text-danger">
                    <p>{{ $error }}</p>
                </div>
            @endforeach

        </div>
    @endif
@endsection
