<!-- HEADER -->
<?php include "include/header.php" ?>

<!-- NAVIGATION BAR -->
<?php include "include/navigation.php" ?>


<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">

            <!-- Post content-->

            <!-- Post header-->
            <article>

                <?php

                if (isset($_GET["p_id"])) {
                    global $conn;
                    $post_id = escape($_GET["p_id"]);

                    // POST VIEW COUNT QUERY ------->
                    $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
                    $post_view_count_query = mysqli_query($conn, $query);
                    check_query($post_view_count_query);

                    $query = "SELECT * FROM posts WHERE post_id = $post_id";
                    $post_content_query = mysqli_query($conn, $query);
                    check_query($post_content_query);

                    while ($row = mysqli_fetch_assoc($post_content_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                ?>


                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1 fst-text-capital"><?php echo $post_title ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on <?php echo $post_date ?> by
                                <?php echo $post_author ?></div>
                            <!-- Post categories-->

                            <?php

                            $query = "SELECT * FROM posts WHERE post_id = $post_id";
                            $get_tags_query = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($get_tags_query)) {
                                $post_tags = $row['post_tags'];
                                $tag_array = explode(',', $post_tags);
                                foreach ($tag_array as $tag) {
                                    echo "<a class='badge bg-primary text-decoration-none link-light me-2' href='#!'>{$tag}</a>";
                                }
                            }
                            ?>


                        </header>

                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="images/<?php echo $post_image; ?>" alt="..." />
                        </figure>

                        <!-- Post content-->
                        <section class="mb-5">
                            <p><?php echo $post_content; ?></p>
                        </section>

                <?php
                    }
                } else {

                    header("Location: index.php");
                }
                ?>





            </article>


            <section class="mb-5">

                <div class="card bg-light">

                    <div class="card-body">

                        <!-- COMMENT FORM -->
                        <?php

                        if (isset($_POST['create_comment'])) {
                            global $conn;

                            $post_id = escape($_GET["p_id"]);
                            $comment_author = escape($_POST['comment_author']);
                            $comment_email = escape($_POST['comment_email']);
                            $comment_content = escape($_POST['comment_content']);
                            $comment_status = "Unapproved";
                            // $comment_date = now();

                            $query = "INSERT INTO comments (comment_post_id , comment_author , comment_email , comment_content , comment_status , comment_date) ";
                            $query .= "VALUES ($post_id , '$comment_author' , '$comment_email' , '$comment_content' , '$comment_status' , now())";

                            $create_comment_query = mysqli_query($conn, $query);

                            if (!$create_comment_query) {
                                die("QUERY FAILED" . mysqli_error($conn));
                            } else {
                                echo "
                                    <div class='alert alert-success' role='alert'>
                                        Comment added successfully.
                                    </div>";
                            }
                            
                        }
                        ?>

                        <h4 class="mb-3">Leave a comment</h4>
                        <hr>
                        <form class="form-validation mb-3" action="" method="POST" novalidate>

                            <div class="mb-3">
                                <label for="author" class="form-label">Author Name :</label>
                                <input type="text" class="form-control" name="comment_author" id="author" required placeholder="Jhon Doe">
                                <small id="author_name_validate" class="invalid-feedback">Enter valid Name.</small>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Author Email :</label>
                                <input type="email" class="form-control" name="comment_email" id="email" required placeholder="jhondoe@gmail.com">
                                <small id="author_email_validate" class="invalid-feedback">Enter valid Email.</small>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Author Comment :</label>
                                <textarea class="form-control" rows="3" name="comment_content" id="comment" required placeholder="My comment"></textarea>
                                <small id="author_comment_validate" class="invalid-feedback">Enter your comment.</small>
                            </div>

                            <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>

                        </form>


                        <!-- COMMENT QUERY -->
                        <?php

                        $approved_comment_status = 'Approved';
                        $query = "SELECT * FROM comments WHERE comment_post_id = '$post_id' ";
                        $query .= "AND comment_status = '$approved_comment_status' ";
                        $query .= "ORDER BY comment_id DESC";
                        $show_post_comment = mysqli_query($conn, $query);

                        check_query($show_post_comment);

                        while ($row = mysqli_fetch_assoc($show_post_comment)) {
                            $comment_author = $row['comment_author'];
                            $comment_content = $row['comment_content'];
                            $comment_date = $row['comment_date'];

                        ?>

                            <div class="mt-3">
                                <div class="fw-bold"><?php echo $comment_author ?>
                                    <small class="fw-normal text-muted"><?php echo $comment_date ?></small>
                                </div>
                                <div><?php echo $comment_content ?></div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>

                </div>
            </section>
        </div>

        <!-- SIDEBAR -->
        <?php include "include/sidebar.php" ?>

    </div>
</div>

<!-- FOOTER -->
<?php include "include/footer.php" ?>