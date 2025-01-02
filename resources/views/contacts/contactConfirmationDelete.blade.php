@extends('layouts.main_layout')

@include('layouts.nav_layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/relationshipType.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Deletar contato</h5>

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

            <h4 class="text-dark">{{ $contactName}}</h4>
            <div class="alert" id="{{ strtolower($contactRelationshipType) }}">{{ $contactRelationshipType }}</div>
            <p class="card-text">Ao deletar o contato, <strong>os registros dos presentes dados a ele, também serão deletados.</strong> Essa ação será irreversil.</p>
            @if (count($gifts) == 0)
                <p class="card-text">Nenhum presente vinculado a esse contato.</p>
            @else
            <h5>Presentes:</h5>
            <div class="accordion" id="accordionExample">
                @foreach ($gifts as $index => $gift)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                <strong>{{ $gift->name }}</strong> <br>
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>Preço:</strong> ${{ number_format($gift->price, 2) }}<br>
                                <strong>Data de registro:</strong> {{ date('d/m/Y à\s H\hi', strtotime($gift->created_at)) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
              
            <a href="{{ route('contact.deleteSubmit', ['id' => request()->route('id')]) }}" class="btn btn-danger">Deletar</a>
            <a href="{{ route('contact.listContacts') }}" class="btn btn-primary">Cancelar</a>
    </div>
</div>

@endsection