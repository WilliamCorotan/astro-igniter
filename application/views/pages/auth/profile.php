<?php
$profile_picture = $this->session->userdata('profile_picture');
?>
<div class="container-lg px-4 py-5 my-4 rounded bg-dark bg-opacity-75">
    <div class="d-flex justify-content-between align-items-center ">
        <h4 class="display-4">User Profile</h4>
        <div>
            <a name="edit-profile-button" id="edit-profile-button" class="btn btn-primary" role="button">Edit</a>
        </div>
    </div>
    <div class="row">


        <div class="col-lg-4 ">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-lg-0 bg-transparent border-0">
                <div class="card-title px-3 mt-2">
                    <h3>Profile Picture</h3>
                </div>
                <div class="card-body text-center grid place-items-center">
                    <!-- Profile picture image-->
                    <div class="">
                        <div class="position-relative w-64 h-64 m-0">
                            <div id="profile-picture-container position-relative" class="rounded-circle border border-5 bg-dark w-64 h-64">
                                <img class="img-account-profile rounded-circle w-100 h-100 object-fit-cover" src="<?= base_url("/assets/images/profile_pictures/$profile_picture") ?>" alt="">
                            </div>
                            <div id="upload-icon" class="position-absolute m-3 end-0 bottom-0 text-dark bg-white rounded-circle border border-4 p-2">
                                <i class="fa-solid fa-camera-retro fa-xl"></i>

                            </div>

                        </div>

                    </div>
                    <div id="profile-picture-info" class="d-none text-center">

                        <form id="profile-picture-form" method="post" enctype="multipart/form-data">
                            <label for="profile-upload">
                            </label>
                            <input id="profile-upload" name="userfile" class="btn d-none" type="file" accept="image/*">
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <form id="update-profile-form" method="post">
                <!-- Account details card-->
                <div class="card mb-4 bg-transparent  border-0">
                    <div class="card-title px-3 mt-2">
                        <h3>Account Details</h3>
                    </div>
                    <div class="card-body">
                        <!-- Form Group (username)-->
                        <div class="disabled-fields mb-3">
                            <label class="small mb-1" for="username">Username (how your name will appear to other users on the site)</label>
                            <input class="form-control" id="username" type="text" name="username" value="<?= $this->session->userdata('username') ?>" disabled>
                            <div class="hidden text-danger">
                                <small id="username-errors"></small>
                            </div>
                        </div>

                        <!-- Form Group (email address)-->
                        <div class="disabled-fields mb-3">
                            <label class="small mb-1" for="password">Email address</label>
                            <input class="form-control" id="email" type="email" name="email" value="<?= $this->session->userdata('email') ?>" disabled>
                            <div class="hidden text-danger">
                                <small id="email-errors"></small>
                            </div>
                        </div>

                        <!-- Form Group (old password)-->
                        <div class="edit-password-fields mb-3 d-none">
                            <label class="small mb-1" for="password">Old password</label>
                            <input class="form-control" id="old_password" type="password" name="old_password">
                            <div class="hidden text-danger">
                                <small id="old-password-errors"></small>
                            </div>
                        </div>

                        <!-- Form Group (new password)-->
                        <div class="edit-password-fields mb-3 d-none">
                            <label class="small mb-1" for="password">New password</label>
                            <input class="form-control" id="new_password" type="password" name="new_password">
                            <div class="hidden text-danger">
                                <small id="new-password-errors"></small>
                            </div>
                        </div>

                        <!-- Form Group (confirm password)-->
                        <div class="edit-password-fields mb-3 d-none">
                            <label class="small mb-1" for="password">Confirm password</label>
                            <input class="form-control" id="confirm_password" type="password" name="confirm_password">
                            <div class="hidden text-danger">
                                <small id="confirm-password-errors"></small>
                            </div>
                        </div>

                        <!-- Profile picture save button-->
                        <div class="text-end">
                            <button class="hidden btn btn-primary col-1 d-none" type="submit">Save</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
<div class="container-lg px-4 py-5 my-4 rounded bg-dark bg-opacity-75">
    <div class="d-flex justify-content-between align-items-center ">
        <h4 class="display-4">User Preference</h4>
    </div>
    <div class="row">
        <div class="col">
            <!-- Account details card-->
            <div class="card mb-4 bg-transparent  border-0">

                <div class="card-body">
                    <!-- Form Group (username)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="background-image">Background Image</label>
                        <input class="form-control disabled" id="background-image" type="text" value="user_background" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Theme</label>
                        <input class="form-control disabled" type="text" class="form-control" name="theme" id="theme" value="user_theme" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //click event for the edit profile button
        const spinner = `<div class="position-absolute top-50 start-50 translate-middle spinner-border text-secondary" role="status"> <span class = "visually-hidden" > Loading... </span> </div>`
        $('#edit-profile-button').on('click', function() {

            $('.edit-password-fields').removeClass('d-none');
            $('.hidden').removeClass('d-none');
            $('.disabled-fields').removeAttr('disabled');
            $('.disabled-fields').find('input').removeAttr('disabled');
            $('#profile-picture-info').removeClass('d-none');
            $(this).addClass('d-none');
        })

        //submit event for the update proifile form
        $('#update-profile-form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                type: "post",
                url: "profile/update",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: () => {
                    console.log('me is before')
                },
                success: (response) => {
                    $(this).find('[type=password]').val('');
                    //resets error fields
                    $('#username-errors').html('');
                    $('#username-errors').parent().addClass('hidden');

                    $('#email-errors').html('');
                    $('#email-errors').parent().addClass('hidden');

                    $('#old-password-errors').html('');
                    $('#old-password-errors').parent().addClass('hidden');

                    $('#new-password-errors').html('');
                    $('#new-password-errors').parent().addClass('hidden');

                    $('#confirm-password-errors').html('');
                    $('#confirm-password-errors').parent().addClass('hidden');

                    if (response.form_errors) {

                        if (response.form_errors.username) {
                            $('#username-errors').html(response.form_errors.username);
                        }

                        if (response.form_errors.email) {
                            $('#email-errors').html(response.form_errors.email);
                        }

                        if (response.form_errors.old_password) {
                            $('#old-password-errors').html(response.form_errors.old_password);
                        }

                        if (response.form_errors.new_password) {
                            $('#new-password-errors').html(response.form_errors.new_password);
                        }

                        if (response.form_errors.confirm_password) {
                            $('#confirm-password-errors').html(response.form_errors.confirm_password);
                        }
                    }
                    console.log('me success')
                    console.log(response)
                },
                error: function(response) {
                    console.log('me error')
                    console.log(response.responseText)
                }
            });
        })

        //submit event for the profile picture upload
        $('#profile-picture-form').on('submit', function(event) {
            console.log('is mee: upload');
            event.preventDefault();
            let formData = new FormData();
            const file = $('#profile-upload').get(0).files[0];
            formData.append('file', file);

            console.log(this);
            console.log(formData);
            $.ajax({
                type: "post",
                url: "profile/picture/update",
                contentType: false,
                processData: false,
                cache: false,
                data: formData,
                dataType: "json",
                beforeSend: function() {
                    $('#profile-picture-container').append(spinner);
                },
                success: function(response) {
                    console.log(response)

                    $('.img-account-profile').attr('src', `<?= base_url("/assets/images/profile_pictures/") ?>${response.file_name}`);
                }
            });
        })

        $('#upload-icon').on('click', function(event) {
            $('#profile-upload').trigger('click');
        })

        $('#profile-upload').on('change', function() {
            $('#profile-picture-form').trigger('submit');
        })
    });
</script>