<h4 class="my-3">All Comments</h4>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">All Comment</li>
    </ol>
</nav>

<hr>

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
                <th scope="col">Approve</th>
                <th scope="col">Unapprove</th>
                <th scope="col">Delete</th>
                <!-- <th class="text-center" colspan="2" scope="col">Action</th> -->
            </tr>
        </thead>
        <tbody>
            <?php

            global $conn;
            $query = "SELECT * FROM comments";
            $select_all_comment_query = mysqli_query($conn, $query);
            check_query($select_all_comment_query);

            while ($row = mysqli_fetch_assoc($select_all_comment_query)) {

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

                echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-success' href='comments.php?approve=$comment_id'><i class='fas fa-check-circle'></i> Approve</a></td>";
                echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-warning' href='comments.php?unapprove=$comment_id'><i class='fas fa-times-circle'></i> Unapprove</a></td>";
                echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='comments.php?delete=$comment_id'><i class='fas fa-trash-alt'></i> Delete</a></td>";
                echo "</tr>";
            }
            ?>


            <!-- DELETE COMMENTS QUERY -->
            <?php
            if (isset($_GET['delete'])) {

                $comment_id = escape($_GET['delete']);
                $query = "DELETE FROM comments WHERE comment_id = $comment_id";
                $delete_comment_query = mysqli_query($conn, $query);
                check_query($delete_comment_query);
                
                // UPDATE POST COMMENT COUNT
                // $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
                // $query .= "WHERE post_id = $post_id";
                
                // $update_comment_count = mysqli_query($conn, $query);
                // check_query($update_comment_count);

                header("Location: comments.php");
            }
            ?>

            <!-- UNAPPROVE COMMENTS QUERY -->
            <?php
            if (isset($_GET['unapprove'])) {
                $unapprove_comment_id = escape($_GET['unapprove']);
                $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $unapprove_comment_id";
                $unapprove_comment_query = mysqli_query($conn, $query);
                check_query($unapprove_comment_query);
                header("Location: comments.php");
            }
            ?>

            <!-- APPROVE COMMENTS QUERY -->
            <?php
            if (isset($_GET['approve'])) {
                $approve_comment_id = escape($_GET['approve']);
                $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $approve_comment_id";
                $approve_comment_query = mysqli_query($conn, $query);
                check_query($approve_comment_query);
                header("Location: comments.php");
            }
            ?>


        </tbody>

    </table>

</div>