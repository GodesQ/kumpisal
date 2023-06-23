@extends('layouts.admin-layout')

@section('title', 'MESSAGES LIST')

@push('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('admin-assets/css/emails.css') }}">
@endpush

@section('content')
    <div class="main-container">
        <div class="contact-container">
            <div class="contact-list-container">
                <div class="contact-list-content">
                    @include('admin-page.contact-messages.data')
                </div>
            </div>
            <div class="contact-body-content">
                <div class="message-body-content">
                    <div class="message-load">
                        <div class="message-load-image">
                            <img src="{{ URL::asset('admin-assets/images/icons/icons8-mail.gif') }}" alt="">
                        </div>
                    </div>
                    <div class="client-message"></div>
                    <div class="server-message"></div>
                </div>
                <div class="message-form">
                    <form action="#" method="POST" id="reply_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="reply_to" id="reply_to">
                        <div class="mb-3">
                            <label for="custom_subject" class="form-label">Custom Subject</label>
                            <input type="text" class="form-control" name="custom_subject" id="custom_subject" value="REPLY TO - " readonly disabled>
                        </div>
                        <div class="mb-3">
                            <label for="custom_subject" class="form-label">Message</label>
                            <textarea name="message" id="message" cols="30" rows="3" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3 d-flex justify-content-end">
                            <button class="btn btn-primary" id="reply_btn">Send Message <i class="ti ti-send"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const contact_messages = document.querySelectorAll('.contact');

        contact_messages.forEach(element => {
            element.addEventListener('click', (e) => {
                let data_id = element.getAttribute("data-id");
                let data_name = element.getAttribute("data-name");
                if(data_id == $('#reply_to').val()) return false;
                setActiveMessage(contact_messages, element);

                // show message load
                $('.message-load').show();
                getMessage(data_id);
                getReplyMessages(data_id);

                $('#custom_subject').val(`REPLY TO - ${data_name}`);
                $('#reply_to').val(data_id);
                checkReplyTo();
            })
        });

        function getMessage(data_id) {

            $.ajax({
                url: `contact_message/show/${data_id}`,
                success: function(data) {
                    $('.client-message').html(data);
                }
            })
        }

        function setActiveMessage(contact_messages, message) {
            contact_messages.forEach(element => {
                element.classList.remove('active');
            })
            message.classList.add('active');
        }

        function getReplyMessages(data_id) {
            $.ajax({
                url: `contact_message_replies/${data_id}`,
                success: function(data) {
                    $('.server-message').html(data);
                    // hide message load
                    $('.message-load').hide();
                }
            })
        }

        function checkReplyTo() {
            if($('#reply_to').val() == '' || $('#reply_to').val() == null) {
                $('#message').prop('disabled', true);
                $('#reply_btn').hide();
            } else {
                $('#message').prop('disabled', false);
                $('#reply_btn').show();
            }
        }

        $('#reply_form').submit(function(e) {
            e.preventDefault();
            const token = document.querySelector('input[name="_token"]').value;
            $.ajax({
                url: "{{ route('admin.contact_message_reply.store') }}",
                type: "POST",
                data: {
                    _token: token,
                    reply_to: $('#reply_to').val(),
                    message: $('#message').val(),
                    custom_subject: $('#custom_subject').val()
                },
                beforeSend: function() {
                    $('#reply_btn').hide();
                }
            }).done(function(data) {
                $('#reply_btn').show();
                getReplyMessages($('#reply_to').val());
                $('#message').val('');
            })
        });

        // hide message load
        $('.message-load').hide();
        checkReplyTo()
    </script>
@endpush
