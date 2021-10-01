<?php

if (isset($_POST['checkBoxArray'])) {

    // echo $_POST['checkBoxArray'];

    foreach ($_POST['checkBoxArray'] as $post_value_id) {
        $bulk_options = escape($_POST['bulk_options']);

        switch ($bulk_options) {

            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$post_value_id}'";
                $update_post_status_query = mysqli_query($conn, $query);
                check_query($update_post_status_query);
                break;

            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$post_value_id}'";
                $update_post_status_query = mysqli_query($conn, $query);
                check_query($update_post_status_query);
                break;

            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = '{$post_value_id}'";
                $delete_post_query = mysqli_query($conn, $query);
                check_query($delete_post_query);
                break;

            case 'clone':

                $query = "SELECT * FROM posts WHERE post_id = '{$post_value_id}'";
                $select_post_query = mysqli_query($conn, $query);
                check_query($select_post_query);

                while ($row = mysqli_fetch_assoc($select_post_query)) {
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];
                }

                $query = "INSERT INTO posts(post_category_id , post_title, post_author, post_date , post_image , post_content , post_tags , post_status) ";
                $query .= "VALUES({$post_category_id} , '{$post_title}' , '{$post_author}', '{$post_date}' , '{$post_image}' , '{$post_content}' , '{$post_tags}' , '{$post_status}') ";
                $clone_post_query = mysqli_query($conn, $query);
                check_query($clone_post_query);

                break;
        }
    }
}
?>

<!-- DELETE POST QUERY -->
<?php

if (isset($_GET['delete'])) {

    $post_id = escape($_GET['delete']);
    $query = "DELETE FROM posts WHERE post_id = $post_id";
    $delete_post_query = mysqli_query($conn, $query);
    check_query($delete_post_query);
    header("Location: posts.php");

    // IF WE DELETE PARTICULAR POST THEN ALL COMMENT ALSO DELETE
    // $query = "DELETE FROM comments WHERE comment_post_id = $post_id";
    // $delete_comment_query = mysqli_query($conn, $query);
    // check_query($delete_comment_query);
}

if (isset($_GET['reset'])) {

    $post_id = escape($_GET['reset']);
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = " . mysqli_real_escape_string($conn, $post_id);
    $reset_views_query = mysqli_query($conn, $query);
    check_query($reset_views_query);
    header("Location: posts.php");
}


?>

<h4 class="my-3">All Post</h4>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">All Post</li>
    </ol>
</nav>
<hr>


<form class="row" action="" method="POST">

    <div class="table-responsive">
        <table class="table table-hover table-bordered">

            <div class="bulkOptionContainer row mt-1">
                <div class="col-md-6 col-lg-4 mb-3">
                    <select class="form-control" name="bulk_options" id="">
                        <option value="" selected>Select Options</option>
                        <option value="published">Publish</option>
                        <option value="draft">Draft</option>
                        <option value="delete">Delete</option>
                        <option value="clone">Clone</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <input type="submit" class="btn btn-primary me-2" name="submit" value="Apply">
                    <a class="btn btn-success" href="posts.php?source=add_post">Add new</a>
                </div>
            </div>

            <thead>
                <tr class="table-dark">
                    <th><input type="checkbox" name="" id="selectAllBox"></th>
                    <th scope="col">Id</th>
                    <th scope="col">Author</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                    <th scope="col">Image</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Date</th>
                    <th scope="col">Views</th>
                    <th class="text-center" colspan="3" scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php

                global $conn;
                $query = "SELECT * FROM posts ORDER BY post_id DESC";
                $select_all_post_query = mysqli_query($conn, $query);
                check_query($select_all_post_query);

                while ($row = mysqli_fetch_assoc($select_all_post_query)) {

                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                    $post_views_count = $row['post_views_count'];

                    echo "<tr>";

                ?>

                    <td>
                        <input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>">
                    </td>

                <?php
                    echo "<td>$post_id</td>";
                    echo "<td>$post_author</td>";
                    echo "<td>$post_title</td>";

                    global $conn;
                    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                    $get_category_id_query = mysqli_query($conn, $query);
                    check_query($get_category_id_query);

                    while ($row = mysqli_fetch_assoc($get_category_id_query)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<td>$cat_title</td>";
                    }
                    if ($post_status == 'published') {
                        echo "<td>Published</td>";
                    } else {
                        echo "<td>Draft</td>";
                    }
                    echo "<td><img width='100px' src='../images/$post_image' alt='images'></td>";
                    echo "<td>$post_tags</td>";


                    $comment_count_query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                    $send_query = mysqli_query($conn, $comment_count_query);

                    $comment_id = "";
                    while ($row = mysqli_fetch_assoc($send_query)) {
                        $comment_id = $row['comment_post_id'];
                    }
                    $post_comment_count = mysqli_num_rows($send_query);
                    echo "<td><a href=' post_wise_comment.php?id=$comment_id'>$post_comment_count</a></td>";


                    echo "<td class='text-nowrap'>$post_date</td>";
                    echo "<td class='text-center text-nowrap'>$post_views_count<a class='btn btn-sm btn-info ms-1' href='posts.php?reset={$post_id}'><i class='fas fa-redo-alt'></i></td>";
                    echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-secondary' href='../post.php?p_id={$post_id}'><i class='fas fa-eye'></i> View Post</td>";
                    echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-success' href='posts.php?source=update_post&update_p_id={$post_id}'><i class='fas fa-edit'></i> Edit</td>";
                    echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='posts.php?delete={$post_id}'><i class='fas fa-trash-alt'></i> Delete</td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</form>

<script>
    let select_all_box = document.querySelector("#selectAllBox");
    let checkBox = document.querySelectorAll(".checkBoxes");

    select_all_box.addEventListener("click", function() {
        if (select_all_box.checked) {
            checkBox.forEach(function(element) {
                element.checked = true;
            });
        } else {
            checkBox.forEach(function(element) {
                element.checked = false;
            });
        }
    });
</script>