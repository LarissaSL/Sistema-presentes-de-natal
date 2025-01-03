@extends('layouts.main_layout')

@include('layouts.nav_layout')

@section('content')
    <h1 class="text-center mb-4 mt-5">Meus Contatos</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">

                {{-- Caso deletar seja feito --}}
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </symbol>
                                <symbol id="info-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                </symbol>
                                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </symbol>
                            </svg>

                            <svg class="bi flex-shrink-0 me-2" role="img" style="width: 20px; height: 20px;"
                                aria-label="Success:">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            <div>
                                {{ session('success') }}
                            </div>
                        </div>

                        <!-- Botão de Fechar -->
                        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
                    </div>

            </div>
            @endif

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
                <div class="col-md-8 d-flex justify-content-center  w-100">
                    <a href="{{ route('contact.create') }}" class="btn btn-secondary px-3 ">
                        <i class="fa-regular fa-pen-to-square me-2"></i>Novo contato
                    </a>
                </div>

                {{-- Erros a serem exibidos --}}
                @if ($errors->any())
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                            viewBox="0 0 16 16" role="img" aria-label="Warning:" style="width: 20px; height: 20px;">
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
