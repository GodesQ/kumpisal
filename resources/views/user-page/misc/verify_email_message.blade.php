@extends('layouts.user-layout')

@section('title', 'Verify Email Address')

@section('content')
    @push('styles')
        <style>
            .show {
                display: block !important;
            }

            .hide {
                display: none !important;
            }

            .disabled {
                background: gray !important;
                color: #000 !important;
            }

            .timer-hide {
                opacity: 0 !important;
            }
        </style>
    @endpush
    <main id="main" class="site-main overflow">
        <div class="container-fluid p-5">
            <div class="d-flex justify-content-center align-items-center w-100">
                <div class="border p-3" style="width: 40%;">
                    <div class="text-center border-bottom p-2">
                        <h3>Please Verify Your Email</h3>
                    </div>
                    <div class="container-fluid p-2 pt-4 text-center">
                        <p>You're almost there! We sent an email to <br>
                            <span style="font-weight: 800;">{{ Auth::user()->email }}</span>
                        </p>
                        <p class="mt-4">Just click on the button in that email to complete your signup. <br>
                            If its not found in your inbox, <b>check your spam</b> folder.
                        </p>
                        <p class="mt-4">
                            Still can't find the email?
                        </p>
                        <div class="my-4">
                            <button class="btn btn-primary" id="resend-email">Resend Email</button>
                            <input type="hidden" name="email" id="email" value="{{ Auth::user()->email }}">
                            <div class="mt-3 timer-div timer-hide"> <span id="timer" style="font-weight: 800;">60</span>
                                seconds</div>
                        </div>
                        <p>Need help? <a href="">Contact Us</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        // Check if the timer value exists in localStorage
        let timerValue = localStorage.getItem('timerValue');
        let countdown; // Variable to hold the interval

        $('#resend-email').click(function(e) {
            let data = {
                _token: '{{ csrf_token() }}',
                email: $('#email').val()
            }

            $('.timer-div').removeClass('timer-hide');
            $(e.target).html('Sending...');
            $(e.target).addClass('sending-btn');

            $.ajax({
                url: "{{ route('user.resend_email_verification') }}",
                method: 'POST',
                data: data,
            }).success(function(response) {
                if (response.status) {
                    $('#resend-email').prop('disabled', true);
                    $('#resend-email').addClass('disabled');
                    startTimer();
                }
                $(e.target).html('Resend Email');
                $(e.target).removeClass('sending-btn');
            })
        });

        if (timerValue || parseInt(timerValue) >= 0) {
            // If the timer value exists, convert it to a number
            timerValue = parseInt(timerValue);
            startTimer();
        } else {
            // If the timer value doesn't exist, set it to the desired initial value (in seconds)
            timerValue = 60; // 1 minute
        }

        // Display the initial timer value on the page
        document.getElementById('timer').textContent = timerValue;

        // Function to start the timer
        function startTimer() {
            countdown = setInterval(() => {
                // Decrease the timer value by 1
                timerValue--;

                // Display the timer value on the page
                document.getElementById('timer').textContent = timerValue;

                // Store the updated timer value in localStorage
                localStorage.setItem('timerValue', timerValue.toString());

                // Check if the timer has reached zero
                if (timerValue <= 0) {
                    clearInterval(countdown); // Stop the timer
                    localStorage.removeItem('timerValue'); // Remove the timer value from localStorage

                    // Perform any additional actions when the timer ends
                    $('#resend-email').prop('disabled', false);
                    $('#resend-email').removeClass('disabled');
                    timerValue = parseInt(60);
                    $('.timer-div').addClass('timer-hide');

                    // Display the timer value on the page
                    document.getElementById('timer').textContent = timerValue;
                }

            }, 1000); // 1000 milliseconds = 1 second
        }
    </script>
@endpush
