<!doctype html>
<html lang="en">

<head>
    <title><?= APP_NAME ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Custom External CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">

    <!-- Custom Internal CSS -->
    <style>
        #app {
            background-image: linear-gradient(to bottom,
                    rgba(33, 37, 41, 0.3),
                    rgba(25, 135, 84, 0.3)),
                url('<?= base_url('/assets/images/backgrounds/japan.png') ?>');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            min-height: calc(100vh - 56px) !important;
        }


        @media (min-width: 992px) {

            #app {
                min-height: calc(100vh - 112px) !important;
            }
        }
    </style>
    <!-- JQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="d-flex flex-column min-vh-100 text-white overflow-hidden">
    <header>
        <?php $this->load->view('components/auth/auth-main-navbar'); ?>
    </header>

    <main id="app">