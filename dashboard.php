<?php
session_start();

if (empty($_SESSION['user'])) {
    header('Location: index.php');
}

require './master.php';
load_head('Dashboard');
include './dashboard_component/header.php';
require './connection.php';
?>

<style>
    .page-header {
        font-weight: bold;
        font-size: 40px;
        margin-right: 5px;
    }

    .page-subheader {
        font-size: 20px;
        font-weight: 300;
    }

    .page-body-header {
        border-bottom: 1px solid black;
        margin-bottom: 2rem;
    }

    .dropdown-item {
        transition: 0.25s;
    }

    .dropdown-item:hover {
        transition: 0.25;
        background-color: #c7c7c7;
    }
</style>

<!-- Initial Dashboard Component -->
<div class="container">
    <?php
    $page = @$_GET['page'];
    $user = $_SESSION['user'];
    if ($user['user_level'] === 'ADMIN') {
        if (empty($page) || !file_exists("./route/$page.php")) {
            include './route/welcome.php';
        } else {
            include "./route/$page.php";
        }
    } else {
          include './route/guest.php';
    }
    ?>
</div>

<?php load_footer(); ?>
