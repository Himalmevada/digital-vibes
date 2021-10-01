<?php include "db_conn.php"; ?>
<?php include "function.php"; ?>

<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="./index.php">Digital Vibes</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <?php
                $query = "SELECT * FROM categories";
                $all_categories_query = mysqli_query($conn, $query);
                check_query($all_categories_query);

                while ($row = mysqli_fetch_assoc($all_categories_query)) {
                    $cat_title = escape($row['cat_title']);
                    echo "<li class='nav-item'><a class='nav-link' href='#'>{$cat_title}</a></li>";
                }

                ?>

                <li class="nav-item mb-2 mb-lg-0 me-lg-2"><a class="btn btn-danger" role="button" href="admin_login.php">Admin</a>
                </li>

                <li class="nav-item mb-2 mb-lg-0 me-lg-2"><a class="btn btn-danger" role="button" href="author_login.php">Author</a>
                </li>
                
                <li class="nav-item mb-2 mb-lg-0 me-lg-2"><a class="btn btn-light" role="button" href="register.php">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>