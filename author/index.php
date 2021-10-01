<!-- HEADER -->
<?php include "include/author_header.php" ?>

<!-- NAVIGATION BAR -->
<?php include "include/author_navigation.php" ?>

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

            <h3 class="my-3">Welcome to author
                <span class="text-primary text-capitalize">
                    <?php echo $_SESSION['username']; ?>
                </span>
            </h3>

            <h4 class="my-3">Dashboard</h4>
            <hr>

            <div class="row">

                <!-- TOTAL POST QUERY -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">

                                    <?php
                                    $query = "SELECT * FROM posts WHERE post_author = '{$_SESSION['username']}'";
                                    $select_all_post = mysqli_query($conn, $query);
                                    $post_count = mysqli_num_rows($select_all_post);

                                    echo "<div class='fw-bold fs-3'>$post_count</div>";
                                    ?>
                                    <div class="h6 text-uppercase">Total Post</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-3x"></i>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between bg-white">
                            <a class="small stretched-link text-decoration-none text-danger" href="posts.php">View Posts</a>
                            <div class="small text-danger">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PUBLISHED POST QUERY -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">

                        <div class="card-body">

                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <?php

                                    $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_author = '{$_SESSION['username']}'";
                                    $all_published_post = mysqli_query($conn, $query);
                                    $published_post_count = mysqli_num_rows($all_published_post);

                                    echo "<div class='fw-bold fs-3'>$published_post_count</div>";
                                    ?>
                                    <div class="h6 text-uppercase">Published Post</div>
                                </div>
                                <div class="col-auto">
                                <i class="fas fa-file-alt fa-3x"></i>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between bg-white">
                            <a class="small stretched-link text-decoration-none text-success" href="posts.php">View Published Post</a>
                            <div class="small text-success">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UNPUBLISHED POST QUERY -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">

                        <div class="card-body">

                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <?php

                                    $query = "SELECT * FROM posts WHERE post_status = 'draft' AND post_author = '{$_SESSION['username']}'";
                                    $all_draft_post = mysqli_query($conn, $query);
                                    $draft_post_count = mysqli_num_rows($all_draft_post);

                                    echo "<div class='fw-bold fs-3'>$draft_post_count</div>";
                                    ?>
                                    <div class="h6 text-uppercase">Draft Post</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-3x"></i>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between bg-white">
                            <a class="small stretched-link text-decoration-none" href="posts.php">View Draft Post</a>
                            <div class="small text-primary">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOTAL COMMENT QUERY -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">

                        <div class="card-body">

                            <div class="row no-gutters align-items-center">
                                <div class="col">

                                    <?php
                                        $post_query = "SELECT * FROM posts WHERE post_author = '{$_SESSION['username']}'";
                                        $select_post_query = mysqli_query($conn, $post_query);
                                        check_query($select_post_query);
                                        $total_comment_count = 0;

                                        while($row = mysqli_fetch_assoc($select_post_query)){
                                            $post_id = $row['post_id'];
                                            $post_author = $row['post_author'];
                                            
                                            $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}'";
                                            $select_all_comment_query = mysqli_query($conn, $query);
                                            check_query($select_all_comment_query);
                                            
                                            $comment_count = mysqli_num_rows($select_all_comment_query);
                                            $total_comment_count = $comment_count + $total_comment_count;
                                        }

                                    // $query = "SELECT * FROM comments";
                                    // $select_all_comment = mysqli_query($conn, $query);
                                    // $comment_count = mysqli_num_rows($select_all_comment);

                                    echo "<div class='fw-bold fs-3'>$total_comment_count</div>";
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

                <!-- TOTAL CATEGORIES QUERY -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">

                        <div class="card-body">

                            <div class="row no-gutters align-items-center">
                                <div class="col">
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
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <?php include "include/author_footer.php" ?>