<!-- HEADER -->
<?php include "include/header.php" ?>

<!-- NAVIGATION BAR -->
<?php include "include/navigation.php" ?>

<!-- Page content-->
<div class="container mt-4">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">

            <?php


            if (isset($_GET['search_text'])) {

                if (isset($_GET['page'])) {
                    $page = escape($_GET['page']);
                } else {
                    $page = 1;
                }

                if ($page == "" || $page == 1) {
                    $on_page = 0;
                } else {
                    $on_page = ($page * 7) - 7;
                }

                $search = escape($_GET['search_text']);

                global $conn;
                $post_query_count = "SELECT * FROM posts WHERE post_status = 'published' AND post_tags LIKE '%$search%'";
                $find_count = mysqli_query($conn, $post_query_count);
                $count_rows = mysqli_num_rows($find_count);

                if ($count_rows == 0) {
                    echo "<h4 class='text-black'>NO RECORD FOUND</h4>";
                } else {
                    echo "<h4 class='text-black'>Record Found : " . $count_rows . "</h4>";
                }

                $count_rows = ceil($count_rows / 7);

                $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_tags LIKE '%$search%' LIMIT $on_page , 7";
                $search_query = mysqli_query($conn, $query);
                check_query($search_query);

                while ($row = mysqli_fetch_assoc($search_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 150);
            ?>

                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="post.php?p_id=<?php echo $post_id ?>"><img class="card-img-top" src="images/<?php echo $post_image ?>" alt="" /></a>
                        <div class='card-body'>
                            <div class="card-info">
                                <span class="text-muted me-2 "><i class="fa fa-user" aria-hidden="true"></i> <a class="link-secondary" href="author_post.php?author=<?php echo $post_author ?>& p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a></span>
                                <span class="small text-muted"><i class="fa fa-calendar-alt" aria-hidden="true"></i>
                                    <?php echo $post_date ?>
                                </span>
                            </div>
                            <h2 class="card-title"><?php echo $post_title ?></h2>
                            <p class="card-text"><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read more →</a>
                        </div>
                    </div>

            <?php
                }
            }
            ?>

            <!-- Pagination-->
            <nav aria-label="Pagination">
                <hr class="my-0" />
                <ul class="pagination justify-content-center my-4">
                    <?php
                    global $count_rows;
                    for ($i = 1; $i <= $count_rows; $i++) {
                        if ($i == $page) {
                            echo "<li class='page-item mx-1 active'><a class='page-link' href='search.php?search_text=$search&page=$i'>$i</a></li>";
                        } else {
                            echo "<li class='page-item mx-1'><a class='page-link' href='search.php?search_text=$search&page=$i'>$i</a></li>";
                        }
                    }
                    ?>
                </ul>
            </nav>

        </div>

        <!-- SIDEBAR -->
        <?php include "include/sidebar.php" ?>

    </div>
</div>
<!-- FOOTER -->
<?php include "include/footer.php" ?>