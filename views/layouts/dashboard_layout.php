<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>

    <link rel="stylesheet" href="<?php echo BASE.'assets/css/main/app.css'?>">
    <link rel="stylesheet" href="<?php echo BASE.'assets/css/main/app-dark.css'?>">
    <link rel="shortcut icon" href="<?php echo BASE.'assets/images/logo/favicon.svg'?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo BASE.'assets/images/logo/favicon.png'?>" type="image/png">

    <link rel="stylesheet" href="<?php echo BASE.'assets/css/shared/iconly.css'?>">

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <!-- <a href="/"><img src="assets/images/logo/logo.svg" alt="Logo" srcset=""> -->VideoConf</a>
                        </div>

                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="/dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item active ">
                            <a href="/users" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Users</span>
                            </a>
                        </li>

                        <li class="sidebar-item active ">
                            <a href="/conferences" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Conferences</span>
                            </a>
                        </li>

                        <li class="sidebar-item active ">
                            <a href="/history" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>History</span>
                            </a>
                        </li>
                        <li class="sidebar-item active ">
                            <a href="reports" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Reports</span>
                            </a>
                        </li>
                        <li class="sidebar-item active ">
                            <a href="/contact_support" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Contact Support</span>
                            </a>
                        </li>
                        <li class="sidebar-item active ">
                            <a href="/notifications" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Notifications</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Create Conferences</h3>
                            <p class="text-subtitle text-muted">Create Conferences for your organisation.</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Input</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <?php require $data['view']; ?>


            </div>



            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2022 &copy; Psychowellness Center</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="https://shiwkesh.online">Shiwkesh Schematics Private Limited</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
   

</body>

</html>