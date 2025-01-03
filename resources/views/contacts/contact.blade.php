@php
    use App\Enums\RelationshipType;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
@endsection

<div class="row justify-content-center">
    <div class="col-md-8"> 
        <div class="card p-4 my-3 contact-card">
            <div class="row">
                <div class="col-md-8">
                    <div class="contact-header">
                        <div class="contact-rect" id="{{ $contact->relationship_type }}"></div>
                        <strong class="contact-name">{{ $contact->name }}</strong>
                    </div>

                    <div class="mt-3 alert" id="{{ $contact->relationship_type }}" role="alert">
                        {{ $contact->relationship_type }}
                    </div>

                    <small class="text-secondary d-block"><span class="opacity-75 me-1">Criado em:
                    </span><strong>{{ date('d/m/Y à\s H\hi', strtotime($contact->created_at)) }}</strong></small>
                    
                    @if ($contact->updated_at && $contact->created_at != $contact->updated_at)
                        <small class="text-secondary d-block"><span class="opacity-75 me-1">Atualizado em:
                        </span><strong>{{ date('d/m/Y à\s H\hi', strtotime($contact->updated_at)) }}</strong></small>
                    @endif
                </div>

                <div class="col-md-4 text-end">  <!-- Diminui a largura da coluna de ícones -->
                    <a href="{{ route('contact.update', ['id' => Crypt::encrypt($contact->id)]) }}" class="me-3 text-decoration-none">
                        <ion-icon name="create" style="font-size: 30px;"></ion-icon>
                    </a>
                    <a href="{{ route('contact.delete', ['id' => Crypt::encrypt($contact->id)]) }}" class="text-danger text-decoration-none">
                        <ion-icon name="close-circle" style="font-size: 30px;"></ion-icon>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
