@forelse ($messages as $message)
<div class="message">
    <div class="message-first">
        <div>
            <h5>{{ $message->admin->name }}</h5>
            <h6>{{ $message->admin->email }}</h6>
        </div>
        <h6>{{ date_format(new DateTime($message->created_at), 'F d, Y')}}</h6>
    </div>
    <div class="message-second">
        <p>
            <?php echo nl2br($message->message) ?>
        </p>
    </div>
</div>
@empty
<div class="my-5">
    <h3 class="text-center">No Replies Found</h3>
</div>
@endforelse
