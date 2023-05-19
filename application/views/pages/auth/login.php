<section id="register-section" class="grid place-items-center min-vh-100 container">
    <div class="bg-dark bg-opacity-75 p-5 rounded">
        <div class="text-center mb-5">
            <h2 class="mb-2">Login</h2>
            <div class="hidden text-danger">
                <small id="login-errors"></small>
            </div>
        </div>
        <form id="login-form" action="" class="text-black row" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username_email" name="username_email" placeholder="Dummy Creds: user">
                <label for="username_email" class="ps-3">Username / Email Address </label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Dummy Creds: password">
                <label for="password" class="ps-3">Password</label>
            </div>
            <div>
                <button type="submit" class="form-button btn btn-primary py-2 w-100">Login</button>
            </div>
        </form>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#app').on('submit', "#login-form", function(event) {
            event.preventDefault();
            const spinner = `<div class="spinner-border text-secondary" role="status"> <span class = "visually-hidden" > Loading... </span> </div>`;

            $.ajax({
                type: "post",
                url: "login/user",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.form-button').attr('disabled');
                    $('.form-button').addClass('disabled');
                    $('.form-button').html(spinner);
                },
                success: function(response) {
                    //reset button loading state
                    $('.form-button').removeAttr('disabled')
                    $('.form-button').removeClass('disabled')
                    $('.form-button').html('Login')


                    $('#login-errors').html('')
                    $('#login-errors').parent().addClass('hidden')

                    //Checks if response contains form errors
                    if (response.login_errors) {
                        $('#login-errors').html(response.login_errors)
                        $('#login-errors').parent().removeClass('hidden')
                    }
                    //redirects if registered successfully  
                    else {

                        window.location.replace("/dashboard");
                    }
                }
            });

        })
    });
</script>