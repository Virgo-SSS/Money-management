<form action="{{ route('register') }}" method="POST" id="register_form">
    @csrf
    <div id="register">
        <label for="chk" aria-hidden="true" class="signup-title">SIGN UP</label>
        <div class="error_text">
            <span>{{ $errors->register->any() ? $errors->register->first() : '' }}</span>
        </div>
        <input type="text" id="regis_username" name="name" placeholder="Username" required>
        <div class="error_text">
            <span id="error_regis_username"></span>
        </div>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <div class="error_text">
            <span id="error_email"></span>
        </div>
        <input type="password" id="regis_password" name="password" placeholder="Password" required>
        <div class="error_text">
            <span id="error_regis_password"></span>
        </div>
        <input type="password" id="confirm_password" name="password_confirmation" placeholder="Confirm Password" required>
        <div class="error_text">
            <span id="error_confirm_password"></span>
        </div>
        <button type="submit" id="btn-register">Sign up</button>
    </div>

</form>


@push('js')
    <script>
        function register_validation(event) {
            let {
                id,
                value
            } = event.target;

            if (id == "") return;

            switch(id){
                case 'regis_username':
                    if (value == '') {
                        $('#error_' + id).text("Username is required");
                    }

                    if ($('#error_' + id).val() == '' && value != ''){
                        $.ajax({
                            url: "{{ route('validation.register.check') }}",
                            method: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                attribute: id,
                                value
                            },
                            success: function (response) {
                               $('#error_' + id).text('');
                            },
                            error: function (error) {
                                $('#error_' + id).text(error.responseText);
                            }
                        });
                    }
                    break;
                case 'email':
                    if(value == ''){
                        $('#error_' + id).text("Email is required");
                    }
                    if ($('#error_' + id).val() == '' && value != ''){
                        $.ajax({
                            url: "{{ route('validation.register.check') }}",
                            method: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                attribute: id,
                                value
                            },
                            success: function (response) {
                                $('#error_' + id).text('');
                            },
                            error: function (error) {
                                $('#error_' + id).text(error.responseText);
                            }
                        });
                    }
                    break;
                case 'regis_password':
                    if (value.length < 6) {
                        $('#error_' + id).text("Password must be at least 6 characters");
                    } else {
                        $('#error_' + id).text("");
                    }
                    break;
                case 'confirm_password':
                    if (value != $('#regis_password').val()) {
                        $('#error_' + id).text("Password does not match");
                    } else {
                        $('#error_' + id).text("");
                    }
                    break;
            }
        }
        $(function () {
            $('#register > input').each(function () {
                $(this).on('input blur', register_validation);
            });
        });

        $('#btn-register').on('click', function () {
            $('#btn-register').attr('disabled', true);
            $('input:not([type="hidden"]), select').each(function () {
                register_validation({
                    target: {
                        id: this.id,
                        value: this.value
                    }
                });
            });

            $('#register_form').submit();
        });
    </script>
@endpush
