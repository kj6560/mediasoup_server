<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php

            use App\AppHelpers;

            $current_role = $data['current_user']['user_role'];
            echo SITE_NAME; ?></title>

    <link rel="stylesheet" href="<?php echo BASE . 'assets/css/main/app.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE . 'assets/css/main/app-dark.css' ?>">
    <link rel="shortcut icon" href="<?php echo BASE . 'assets/images/logo/favicon.svg' ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo BASE . 'assets/images/logo/favicon.png' ?>" type="image/png">

    <link rel="stylesheet" href="<?php echo BASE . 'assets/css/shared/iconly.css' ?>">

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <!-- <a href="/"><img src="assets/images/logo/logo.svg" alt="Logo" srcset=""> --><?php echo SITE_NAME ?></a>
                        </div>

                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">


                        <li class="sidebar-item active ">
                            <a href="/dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <?php if (AppHelpers::canEdit($current_role)) { ?>
                            <li class="sidebar-item active ">
                                <a href="/users" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (AppHelpers::isAdmin($current_role)) { ?>
                            <li class="sidebar-item active ">
                                <a href="/clients" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Clients</span>
                                </a>
                            </li>

                        <?php } ?>

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
                        <?php if (AppHelpers::isAdmin($current_role)) { ?>
                            <li class="sidebar-item active ">
                                <a href="/access_logs" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Access Logs</span>
                                </a>
                            </li>
                        <?php } ?>
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
                        <li class="sidebar-item active ">
                            <a href="/logout" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Logout(<?php echo $data['current_user']['name'] ?>)</span>
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
                            <h3><?php echo !empty($data['page_heading']) ? $data['page_heading'] : '' ?></h3>
                            <p class="text-subtitle text-muted"><?php echo !empty($data['page_description']) ? $data['page_description'] : ''; ?></p>
                        </div>

                        <div class="alert alert-<?php echo !empty($data['msg']['code']) ? 'show' : 'hide' ?> alert-dismissible fade <?php echo !empty($data['msg']) ? 'show' : 'hide' ?>" role="alert">
                            <?php
                            if ($data['msg']) {
                                echo $data['msg']['text'];
                            }
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>


</body>
<script>
    function hasClass(el, className) {
        if (el.classList)
            return el.classList.contains(className);
        return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
    }

    function addClass(el, className) {
        if (el.classList)
            el.classList.add(className)
        else if (!hasClass(el, className))
            el.className += " " + className;
    }

    function removeClass(el, className) {
        if (el.classList)
            el.classList.remove(className)
        else if (hasClass(el, className)) {
            var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
            el.className = el.className.replace(reg, ' ');
        }
    }
</script>

</html>