@extends('layouts.main_layout')

@include('layouts.nav_layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
@endsection

@section('content')
<div class="modal show d-block" tabindex="-1" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deletar contato</h5>
                <a href="{{ route('contact.listContacts') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="contact-header">
                    <div class="contact-rect" id="{{ $contactRelationshipType }}"></div>
                    <strong class="contact-name">{{ $contactName }}</strong>
                </div>

                <div class="mt-3 alert" id="{{ $contactRelationshipType }}" role="alert">
                    {{ $contactRelationshipType }}
                </div>
                <p class="card-text mt-2">
                    Ao deletar o contato, <strong>os registros dos presentes dados a ele, também serão deletados.</strong> 
                    Essa ação será irreversível.
                </p>

                @if (count($gifts) == 0)
                    <p class="card-text">Nenhum presente vinculado a esse contato.</p>
                @else
                    <h5 class="mt-5">Presentes:</h5>
                    <div class="accordion" id="accordionExample">
                        @foreach ($gifts as $index => $gift)
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                        <strong>{{ $gift->name }}</strong>
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
            </div>
            <div class="modal-footer">
                <a href="{{ route('contact.deleteSubmit', ['id' => request()->route('id')]) }}" class="btn btn-danger">Deletar</a>
                <a href="{{ route('contact.listContacts') }}" class="btn btn-primary">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection
