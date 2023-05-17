<section id="register-section" class="grid place-items-center min-vh-100 container">
    <div class="bg-dark bg-opacity-75 p-5 rounded">
        <h2 class="mb-3 text-center">Register</h2>
        <form id="register-form" class="row" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
                <div class="hidden text-danger">
                    <small id="username-errors"></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                <div class="hidden text-danger">
                    <small id="email-errors"></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="hidden text-danger">
                    <small id="password-errors"></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                <div class="hidden text-danger">
                    <small id="confirm-password-errors"></small>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="form-button btn btn-primary w-100">
                    Register
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    $('#app').on('submit', '#register-form', function(event) {
        event.preventDefault();
        const spinner = `<div class="spinner-border text-secondary" role="status"> <span class = "visually-hidden" > Loading... </span> </div>`
        $.ajax({
            type: "POST",
            url: "<?= site_url('/register/user') ?>",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {

                $('.form-button').attr('disabled')
                $('.form-button').addClass('disabled')
                $('.form-button').html(spinner)

            },
            success: function(response) {
                //resets error fields
                $('#username-errors').html('')
                $('#username-errors').parent().addClass('hidden')

                $('#email-errors').html('')
                $('#email-errors').parent().addClass('hidden')

                $('#password-errors').html('')
                $('#password-errors').parent().addClass('hidden')

                $('#confirm-password-errors').html('')
                $('#confirm-password-errors').parent().addClass('hidden')

                //reset button loading state
                $('.form-button').removeAttr('disabled')
                $('.form-button').removeClass('disabled')
                $('.form-button').html('Register')


                //Checks if response contains form errors
                if (response.form_errors) {
                    if (response.form_errors.username) {
                        $('#username-errors').html(response.form_errors.username)
                        $('#username-errors').parent().removeClass('hidden')
                        console.log(response.form_errors.username)
                    }
                    if (response.form_errors.email) {
                        $('#email-errors').html(response.form_errors.email)
                        $('#email-errors').parent().removeClass('hidden')
                        console.log(response.form_errors.email)
                    }
                    if (response.form_errors.password) {
                        $('#password-errors').html(response.form_errors.password)
                        $('#password-errors').parent().removeClass('hidden')
                        console.log(response.form_errors.password)
                    }
                    if (response.form_errors.confirm_password) {
                        $('#confirm-password-errors').html(response.form_errors.confirm_password)
                        $('#confirm-password-errors').parent().removeClass('hidden')
                        console.log(response.form_errors.confirm_password)
                    }
                }
                //redirects if registered successfully  
                else {

                    window.location.replace("/");
                }

            }
        });
    })
</script>