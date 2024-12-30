@extends('layouts.main_layout')

@section('content')
    <div class="container mt-5">
        <h1>É Natal</h1>
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" id="password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if (session('loginError'))
                    <div class="text-danger">{{ session('loginError') }}</div>
                @endif
            </div>


            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="mt-3">
            <a href="{{ route('user.register') }}" class="btn btn-secondary">Cadastrar</a>
        </div>
    </div>
@endsection
