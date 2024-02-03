<?php
include "php_files/config.php";

if (!file_exists('php_files/database.php')) {
    header('location: install');
    die();
}

if (!session_id()) {
    session_start();
}

if (!isset($_SESSION['admin_fullname'])) {
    header("location: index.php");
}

$db = new Database();
$db->select('settings', '*', null, null, null, null);
$result = $db->getResult();
//$currency_format = $result[0]['currency'];



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if (isset($title) && $title != '') { ?>
        <title>
            <?php echo $title . ' > ' . $result[0]['site_name']; ?>
        </title>
    <?php } else { ?>
        <title>
            <?php echo $result[0]['site_name']; ?>
        </title>
    <?php } ?>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="assets/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="assets/css/datatables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <?php
                if (!empty($result[0]['site_logo'])) { ?>
                    <a href="dashboard.php" class="navbar-brand p-0 text-dark"><img
                            src="images/site-logo/<?php echo $result[0]['site_logo']; ?>"></a>
                <?php } else { ?>
                    <h2><a href="dashboard.php" class="navbar-brand p-0 text-dark">

                        </a></h2>
                <?php } ?>
            </div>

            <ul class="list-unstyled components">
                <li <?php if (basename($_SERVER['PHP_SELF']) == "dashboard.php")
                    echo 'class="active"'; ?>>
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == "vehicle-category.php")
                    echo 'class="active"'; ?>>
                    <a href="vehicle-category.php">Vehicle Category</a>
                </li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == "vehicle.php")
                    echo 'class="active"'; ?>>
                    <a href="vehicle.php">Manage In Vehicle</a>
                </li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == "manage-outgoingvehicle.php")
                    echo 'class="active"'; ?>>
                    <a href="manage-outgoingvehicle.php">Manage Out Vehicle</a>
                </li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == "reports.php")
                    echo 'class="active"'; ?>>
                    <a href="reports.php">Reports</a>
                </li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == "settings.php")
                    echo 'class="active"'; ?>>
                    <a href="settings.php">Settings</a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid p-0">
            <div class="content">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                            </svg>
                            <!-- <span>Toggle Sidebar</span> -->
                        </button>
                        <!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button> -->
                        <div class="dropdown" style="padding:12px 0;">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hi,
                                <?php echo $_SESSION['admin_fullname']; ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="profile.php">My Profile</a>
                                <a class="dropdown-item logout" href="#">Log Out</a>
                            </div>
                        </div>
                    </div>
                </nav>