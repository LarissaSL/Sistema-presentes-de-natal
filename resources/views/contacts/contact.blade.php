@php
    use App\Enums\RelationshipType;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/relationshipType.css') }}">
@endsection


<div class="row">
    <div class="col">
        <div class="card p-4 my-3">
            <div class="row">
                <div class="col">
                    <h3 class="text-dark">Contato {{ $loop->index + 1 }}</h3>
                    <h4 class="text-dark">{{ $contact->name }}</h4>


                    <div class="alert {{ match ($contact->relationship_type) {
                        'Familia' => 'familia',
                        'Amigo' => 'amigo',
                        'Trabalho' => 'trabalho',
                        'Romântico' => 'romantico',
                        'Conhecido' => 'conhecido',
                        default => 'outros',
                    } }}"
                        role="alert">
                        {{ $contact->relationship_type }}
                    </div>

                    <small class="text-secondary"><span class="opacity-75 me-2">Criado em:
                        </span><strong>{{ date('d/m/Y à\s H\hi', strtotime($contact->created_at)) }}</strong></small>
                    @if ($contact->updated_at && $contact->created_at != $contact->updated_at)
                        <small class="text-secondary ms-5"><span class="opacity-75 me-2">Atualizado em:
                            </span><strong>{{ date('d/m/Y à\s H\hi', strtotime($contact->updated_at)) }}</strong></small>
                    @endif
                </div>
                <div class="col text-end">
                    <a href="{{ route('contact.update', ['id' => Crypt::encrypt($contact->id)]) }}"
                        class="me-3 text-decoration-none">
                        <ion-icon name="create" style="font-size: 30px;"></ion-icon>
                    </a>
                    <a href="{{ route('contact.delete', ['id' => Crypt::encrypt($contact->id)]) }}"
                        class="text-danger text-decoration-none">
                        <ion-icon name="close-circle" style="font-size: 30px;"></ion-icon>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
