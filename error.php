<?php
ob_start();
$page_title = 'All Product';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(false);

?>
    <!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/html">

    <head>
        <meta charset="UTF-8">
        <title>
            Pricetize - Under Maintenance
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://kit.fontawesome.com/eb9107ad61.js" crossorigin="anonymous"></script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

        <link rel="stylesheet"
              href="libs/css/main.css?<?php echo time(); /* appended to disable browser caching css file remove for release*/ ?>" />
    </head>

<body>
<blockquote class="blockquote">
</br>
</br>
    <p class="mb-0">Not what you were expecting huh? We're sorry.

    <h1 class="display-4">Pricetize will be back soon.</h1>

    </br> We're doing maintenance to make the site better for you.
    <footer class="blockquote-footer">The Pricetize Dev Team </footer>
    </p>
</blockquote>
</body>