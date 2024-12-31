@extends('layouts.main_layout')

@include('layouts.nav_layout')

@section('content')
    <h1>Meus Contatos</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">

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

                    @foreach ($contacts as $contact)
                        @include('contact')
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection
