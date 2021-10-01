<!-- HEADER -->
<?php include "include/author_header.php" ?>

<!-- NAVIGATION BAR -->
<?php include "include/author_navigation.php" ?>

<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4">

            <h4 class="my-3">Post wise Comment</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Post wise Comment</li>
                </ol>
            </nav>

            <hr>

            <div class="row">

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">Id</th>
                                <th scope="col">Author</th>
                                <th scope="col">Email</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Responce to</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($_GET['id']) && !empty($_GET['id'])) {

                                global $conn;
                                $get_id = escape($_GET['id']);
                                $set_query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($conn, $get_id) . " ";
                                $post_comment_query = mysqli_query($conn, $set_query);
                                check_query($post_comment_query);

                                while ($row = mysqli_fetch_assoc($post_comment_query)) {

                                    $comment_id = $row['comment_id'];
                                    $comment_post_id = $row['comment_post_id'];
                                    $comment_author = $row['comment_author'];
                                    $comment_content = $row['comment_content'];
                                    $comment_email = $row['comment_email'];
                                    $comment_status = $row['comment_status'];
                                    $comment_date = $row['comment_date'];

                                    echo "<tr>";
                                    echo "<td>$comment_id</td>";
                                    echo "<td>$comment_author</td>";
                                    echo "<td>$comment_email</td>";
                                    echo "<td>$comment_content</td>";
                                    echo "<td>$comment_status</td>";

                                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                    $get_reference_post_id_query = mysqli_query($conn, $query);

                                    echo "<td class='text-nowrap'>$comment_date</td>";

                                    while ($row = mysqli_fetch_assoc($get_reference_post_id_query)) {
                                        $post_id = $row['post_id'];
                                        $post_title = $row['post_title'];
                                        echo "<td><a class='btn btn-sm btn-link' href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                                    }
                                    echo "</tr>";
                                }
                            } else {
                                echo "<h4 class='text-info'>There is no comment<h4>";
                            }
                            ?>
                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <?php include "include/author_footer.php" ?>