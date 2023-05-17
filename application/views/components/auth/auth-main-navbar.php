<?php
$profile_picture = $this->session->userdata('profile_picture');
?>
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark" data-bs-theme="dark">
    <div class="container-md">
        <a class="navbar-brand" href="#"><?= APP_NAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse my-3" id="navbarSupportedContent">
            <!-- Search Form -->
            <form id="search-form" class="d-flex" role="search">
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <div class="mt-3 d-block d-lg-none text-center fs-5">
                <span>Welcome back, <?= $this->session->userdata('username') ?></span>
            </div>
            <!-- Navigation Items -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Notification</a>
                </li>
                <li class="nav-item  d-block d-lg-none">
                    <a class="profile-button nav-link" type="button" role="button">Profile</a>
                </li>
                <li class="nav-item  d-block d-lg-none">
                    <a class="logout-button nav-link" type="button" role="button">Logout</a>
                </li>
                <li class="nav-item dropdown d-lg-block d-none">
                    <a class="nav-link dropdown-toggle" type="button" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url("/assets/images/profile_pictures/$profile_picture") ?>" class="h-100" alt="" width="48px">
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item text-wrap">Welcome back, <?= $this->session->userdata('username') ?></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="profile-button dropdown-item" type="button" role="button">Profile</a></li>
                        <li><a class="logout-button dropdown-item" type="button" role="button">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    $('#main-navbar').on('click', '.logout-button', function() {
        $.ajax({
            type: "post",
            url: "logout",
            dataType: "json",
            success: function(response) {
                console.log('logged out')
                window.location.replace('/')
            }
        });
    })
</script>