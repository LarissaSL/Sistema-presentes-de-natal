@extends('layouts.main_layout')

@include('layouts.nav_layout')

@section('content')
    <h1>Meus Contatos</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">

                @session('sucess')
                    {{ $message }}
                @endsession
                
                @if (count($contacts) == 0)
                    {{-- Caso não tenha contatos --}}
                    <div class="row mt-5">
                        <div class="col text-center">
                            <p class="display-6 mb-5 text-secondary opacity-50">Você não tem nenhum contato registrado!</p>
                            <a href="{{ route('contact.create') }}" class="btn btn-secondary btn-lg p-3 px-5">
                                <i class="fa-regular fa-pen-to-square me-3"></i>Crie seu primeiro contato!
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Caso tenha --}}
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('contact.create') }}" class="btn btn-secondary px-3">
                            <i class="fa-regular fa-pen-to-square me-2"></i>Novo contato
                        </a>
                    </div>

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

                    @foreach ($contacts as $contact)
                        @include('contacts.contact')
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection
