@forelse ($messages as $message)
    <div class="contact" data-id="{{ $message->id }}" data-name="{{ $message->firstname . ' ' . $message->lastname }}">
        <div class="contact-first">
            <h5>{{ $message->firstname . ' ' . $message->lastname }}</h5>
            <h6>{{ date_format(new DateTime($message->created_at), 'F d, Y') }}</h6>
        </div>
        <div class="contact-second">
            <p>{{ strlen($message->message) > 150 ? substr($message->message, 0, 150) . '...' : $message->message }}</p>
        </div>
    </div>
@empty
    <h4 class="text-center">No Messages Found</h4>
@endforelse
<div class="my-2">
    {{ $messages->links() }}
</div>
