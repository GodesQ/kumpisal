<div class="message">
    <div class="message-first">
        <div>
            <h5>{{ $message->firstname . ' ' . $message->lastname }}</h5>
            <h6>{{ $message->email }}</h6>
        </div>
        <h6>{{ date_format(new DateTime($message->created_at), 'F d, Y')}}</h6>
    </div>
    <div class="message-second">
        <p>
            <?php echo nl2br($message->message) ?>
        </p>
    </div>
</div>
