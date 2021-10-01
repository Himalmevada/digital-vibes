<!-- HEADER -->
<?php include "include/header.php" ?>

<!-- NAVIGATION BAR -->
<?php include "include/navigation.php" ?>

<div class="container">
    <div class="row mt-4">
        <!-- Blog entries-->
        <div class="col-lg-8">

            <?php

            if (isset($_GET['category'])) {

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

                $post_id = escape($_GET['category']);
                global $conn;

                $post_query_count = "SELECT * FROM posts WHERE post_category_id = $post_id AND post_status = 'published'";
                $find_count = mysqli_query($conn, $post_query_count);
                $count_rows = mysqli_num_rows($find_count);

                echo "<h4 class='text-black'>Record Found : " . $count_rows . " </h4>";

                $count_rows = ceil($count_rows / 7);

                $query = "SELECT * FROM posts WHERE post_category_id = $post_id ";
                $query .= "AND post_status = 'published'  LIMIT $on_page , 7";
                $all_post_query = mysqli_query($conn, $query);
                check_query($all_post_query);

                // FOR PAGINATION TO STORE CATEGORY AND CHANGE PAGE
                $post_category_id = $post_id;
                // global $post_category_id;

                while ($row = mysqli_fetch_assoc($all_post_query)) {

                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 150);

            ?>

                    <!-- Featured blog post-->
                    <div class="card mb-4 ">
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
                    for ($i = 1; $i <= $count_rows; $i++) {
                        if ($i == $page) {
                            echo "<li class='page-item mx-1 active'><a class='page-link' href='category.php?category=$post_category_id&page=$i'>$i</a></li>";
                        } else {
                            echo "<li class='page-item mx-1'><a class='page-link' href='category.php?category=$post_category_id&page=$i'>$i</a></li>";
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