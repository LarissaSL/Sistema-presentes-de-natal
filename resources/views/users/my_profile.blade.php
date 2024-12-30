@extends('layouts.main_layout')

@include('layouts.nav_layout')
@section('content')
    <h1 class="text-center mb-4 mt-5">Meu Perfil</h1>

    <form action="{{ route('user.update', ['id' => session('user.id')]) }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ session('user.id') }}">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $name }}">
                        <label for="name">Nome</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $email }}">
                        <label for="email">Email</label>
                    </div>

                    {{-- Campos para a senha --}}
                    
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="senha">
                        <label for="password">Senha</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="passwordConfirmed" placeholder="confirmar senha">
                        <label for="password">Confirmar nova senha</label>
                    </div>
                    
                    <small class="form-text text-muted mb-3">
                        Para alterar sua senha, basta digitar uma nova.
                    </small>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
