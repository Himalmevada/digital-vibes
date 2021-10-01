<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">CMS Admin</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    <div class="ms-auto">
        <ul class="navbar-nav ms-md-0 me-3 me-lg-4 align-item-center">
            
            <li class="nav-item">
                <a class="nav-link mx-1" href="../index.php">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                </a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    <img class="rounded-circle mx-0" src="../images/<?php echo $_SESSION['user_image']; ?>" width="32px" height="32px" alt="user_image">
                    <span class="mx-1 text-capitalize"><?php echo $_SESSION['username'] ?></span></a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="profile.php">
                            <i class="bi bi-person-fill"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item bg-danger text-white" href="../include/logout.php">
                            <i class="fas fa-power-off"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#post-collapse" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Posts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="post-collapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link py-1" href="posts.php">Show all Post</a>
                                <a class="nav-link py-1" href="posts.php?source=add_post">Add Post</a>
                            </nav>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="categories.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-list" aria-hidden="true"></i></div>
                            Categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="comments.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-comments" aria-hidden="true"></i></div>
                            Comments
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-id-card"></i></div>
                            Profile
                        </a>
                    </li>

                </div>
            </div>
        </nav>
    </div>