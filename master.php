<?php function load_head($title)
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= @$title ?> | SI Perhotelan</title>

        <!-- jQuery -->
        <script src="components/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="components/bootstrap/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="components/bootstrap/css/bootstrap.min.css">
        <!-- jQuery DataTable -->
        <script src="components/jquery-dataTables/js/jquery.dataTables.min.js"></script>
        <script src="components/jquery-dataTables/js/jquery.dataTables.id-id.js"></script>
        <link rel="stylesheet" href="components/jquery-dataTables/css/jquery.dataTables.min.css">
        <!-- Moment -->
        <script src="components/moment/moment.js"></script>
        <!-- The Easy Hack -->
        <script src="components/munn-easyhack/easyhack-modal-form.js"></script>
        <script src="components/munn-easyhack/easyhack-family.js"></script>
    </head>

    <body style="margin-top:4.4rem;">
    <?php } ?>

    <?php function load_footer()
    { ?>
    </body>

    </html>
<?php } ?>
