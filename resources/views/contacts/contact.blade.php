<div class="row">
    <div class="col">
        <div class="card p-4">
            <div class="row">
                <div class="col">
                    <h4 class="text-info">{{ $contact['title'] }}</h4>
                    <small class="text-secondary"><span class="opacity-75 me-2">Created
                            at:</span><strong>{{ date('Y-m-d H:i:s', strtotime($contact['created_at'])) }}</strong></small>
                    @if ($contact['created_at'] != $contact['updated_at'])
                        <small class="text-secondary ms-5"><span class="opacity-75 me-2">Updated
                                at:</span><strong>{{ date('Y-m-d H:i:s', strtotime($contact['updated_at'])) }}</strong></small>
                    @endif
                </div>
                <div class="col text-end">
                    <a href="{{ route('contact.update', ['id' => Crypt::encrypt($contact['id'])]) }}"
                        class="btn btn-outline-secondary btn-sm mx-1"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="{{ route('contact.delete', ['id' => Crypt::encrypt($contact['id'])]) }}"
                        class="btn btn-outline-danger btn-sm mx-1"><i class="fa-regular fa-trash-can"></i></a>
                </div>
            </div>
            <hr>
            <p class="text-secondary">{{ $contact['text'] }}</p>
        </div>
    </div>
</div>