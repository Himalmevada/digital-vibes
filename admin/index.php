<!-- HEADER -->
<?php include "include/admin_header.php" ?>

<!-- NAVIGATION BAR -->
<?php include "include/admin_navigation.php" ?>

<?php

if (isset($_SESSION['username'])) {

    if ((time() - $_SESSION['session_time']) > 1200) {
        header("Location: ../include/logout.php");
    }
} else {
    header("Location: ../index.php");
}

?>



<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4">

            <h3 class="my-3">Welcome to admin
                <span class="text-primary text-capitalize">
                    <?php echo $_SESSION['username']; ?>
                </span>
            </h3>

            <h4 class="my-3">Dashboard</h4>
            <hr>

            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">

                                    <!-- POST QUERY -->
                                    <?php
                                    $query = "SELECT * FROM posts";
                                    $select_all_post = mysqli_query($conn, $query);
                                    $post_count = mysqli_num_rows($select_all_post);

                                    echo "<div class='fw-bold fs-3'>$post_count</div>";
                                    ?>
                                    <div class="h6 text-uppercase">Posts</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-3x"></i>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between bg-white">
                            <a class="small stretched-link text-decoration-none" href="posts.php">View Posts</a>
                            <div class="small text-primary ">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">

                        <div class="card-body">

                            <div class="row no-gutters align-items-center">
                                <div class="col">

                                    <!-- COMMENT QUERY -->
                                    <?php

                                    $query = "SELECT * FROM comments";
                                    $select_all_comment = mysqli_query($conn, $query);
                                    $comment_count = mysqli_num_rows($select_all_comment);

                                    echo "<div class='fw-bold fs-3'>$comment_count</div>";
                                    ?>

                                    <div class="h6 text-uppercase">Comments</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-3x"></i>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between bg-white">
                            <a class="small stretched-link text-decoration-none text-warning" href="comments.php">View
                                Comments</a>
                            <div class="small text-warning">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">

                        <div class="card-body">

                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <!-- CATEGORIES QUERY -->
                                    <?php

                                    $query = "SELECT * FROM categories";
                                    $select_all_category = mysqli_query($conn, $query);
                                    $category_count = mysqli_num_rows($select_all_category);

                                    echo "<div class='fw-bold fs-3'>$category_count</div>";
                                    ?>
                                    <div class="h6 text-uppercase">Categories</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list fa-3x"></i>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between bg-white">
                            <a class="small stretched-link text-decoration-none text-success" href="categories.php">View
                                Categories</a>
                            <div class="small text-success">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">

                        <div class="card-body">

                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <!-- CATEGORIES QUERY -->
                                    <?php

                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query($conn, $query);
                                    $user_count = mysqli_num_rows($select_all_users);

                                    echo "<div class='fw-bold fs-3'>$user_count</div>";
                                    ?>
                                    <div class="h6 text-uppercase">Users</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-3x"></i>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between bg-white">
                            <a class="small stretched-link text-decoration-none text-danger" href="users.php">View Users</a>
                            <div class="small text-primary text-danger">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- //<?php
                // $query = "SELECT * FROM posts WHERE post_status = 'published'";
                // $all_published_post = mysqli_query($conn, $query);
                // $published_post_count = mysqli_num_rows($all_published_post);

                // $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                // $all_draft_post = mysqli_query($conn, $query);
                // $draft_post_count = mysqli_num_rows($all_draft_post);

                // $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                // $all_unapproved_comment = mysqli_query($conn, $query);
                // $unapproved_comment_count = mysqli_num_rows($all_unapproved_comment);

                // $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                // $all_subscriber_role = mysqli_query($conn, $query);
                // $subscriber_count = mysqli_num_rows($all_subscriber_role);

                // $query = "SELECT * FROM users WHERE user_role = 'admin'";
                // $all_admin_role = mysqli_query($conn, $query);
                // $admin_count = mysqli_num_rows($all_admin_role);
            
            ?> -->


            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <?php include "include/admin_footer.php" ?>