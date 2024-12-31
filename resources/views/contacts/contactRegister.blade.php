@php
use App\Enums\RelationshipType;
@endphp

@extends('layouts.main_layout')

@include('layouts.nav_layout')
@section('content')
    <h1 class="text-center mb-4 mt-5">Novo contato</h1>

    <form action="{{ route('contact.createSubmit') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ session('user.id') }}">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    {{-- Campos --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}">
                        <label for="name">Nome</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Categoria" name="category">
                            @foreach (RelationshipType::values() as $category)
                                <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                        <label for="category">Categoria</label>
                    </div>

                    <small class="form-text text-muted mb-3">
                        Ex.: Pai se encaixaria na categoria Familia.
                    </small>

                    {{-- Erros a serem exibidos --}}
                    @if ($errors->any())
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                                role="img" aria-label="Warning:" style="width: 20px; height: 20px;">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @enderror

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary">Criar contato</button>
                    </div>
            </div>
        </div>
    </div>
</form>
@endsection
