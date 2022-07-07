<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="assets/css/shared/iconly.css">

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
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Profile Statistics</h3>
            </div>
            <?php require $data['view']; ?>

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
    <script src="assets/js/app.js"></script>

    <script src="assets/js/pages/dashboard.js"></script>

</body>

</html>