<div class="col-lg-7 p-0">

    <h4 class="my-3">Update Post</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Post</li>
        </ol>
    </nav>
    <hr>

    <form method="POST" action="" enctype="multipart/form-data">

        <?php

        // To get all post details in input form
        if (isset($_GET['update_p_id'])) {
            global $conn;
            $post_id = escape($_GET['update_p_id']);
            $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
            $get_post_id_query = mysqli_query($conn, $query);
            check_query($get_post_id_query);

            while ($row = mysqli_fetch_assoc($get_post_id_query)) {
                // $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];

                $post_image = $row['post_image'];

                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
                $post_date = date('d-m-y');
            }
        }

        // To update post
        if (isset($_POST['update_post'])) {

            global $conn;
            $post_id = escape($_GET['update_p_id']);
            $post_author = $_SESSION['username'];
            $post_title = escape($_POST['post_title']);
            $post_category_id = escape($_POST['post_category_id']);
            $post_status = escape($_POST['post_status']);
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];
            $post_tags = escape($_POST['post_tags']);
            $post_content = escape($_POST['post_content']);
            $post_date = date('d-m-y');

            if (empty($post_category_id) || empty($post_title) || empty($post_content) || empty($post_tags) || empty($post_status)) {

                echo "
                <div class='alert alert-danger' role='alert'>
                    All fields are required.
                </div>";

            } else {


                move_uploaded_file($post_image_temp, "../images/$post_image");

                if (empty($post_image)) {
                    $query = "SELECT * FROM posts WHERE post_id = $post_id";
                    $get_image = mysqli_query($conn, $query);
                    check_query($get_image);
                    while ($row = mysqli_fetch_assoc($get_image)) {
                        $post_image = $row['post_image'];
                    }
                }

                $image_format = ['jpg', 'png', 'jpeg'];
                $file_ext = explode('.', $post_image);
                $file_ext_check = strtolower(end($file_ext));
                $valid_format =  in_array($file_ext_check, $image_format);

                if ($valid_format) {

                    $query = "UPDATE posts SET ";
                    $query .= "post_title = '{$post_title}', ";
                    $query .= "post_category_id = '{$post_category_id}', ";
                    $query .= "post_date = now(), ";
                    $query .= "post_author = '{$post_author}', ";
                    $query .= "post_status = '{$post_status}', ";
                    $query .= "post_tags = '{$post_tags}', ";
                    $query .= "post_content = '{$post_content}', ";
                    $query .= "post_image = '{$post_image}' ";
                    $query .= "WHERE post_id = {$post_id}";

                    $update_post_query = mysqli_query($conn, $query);
                    check_query($update_post_query);

                    echo "
                        <div class='alert alert-success' role='alert'>
                            Post updated successully.  <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>Edit More Post</a>
                        </div>";
                } else {
                    echo "
                        <div class='alert alert-warning' role='alert'>
                            Image Format : JPG , JPEG , PNG. 
                        </div>";
                }
            }
        }

        ?>


        <div class="form-group mb-3">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" id="title" name="post_title" value="<?php echo $post_title; ?>">
        </div>

        <div class="form-group mb-3">

            <label for="category">Post Category</label>

            <select class="form-select" name="post_category_id" id="post_category">
                <?php
                global $conn;
                $query = "SELECT * FROM categories";
                $get_categories_query = mysqli_query($conn, $query);
                check_query($get_categories_query);

                while ($row = mysqli_fetch_assoc($get_categories_query)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
                ?>
            </select>

        </div>

        <div class="mb-3">
            <label for="status">Post Status</label>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="post_status" id="draft_radio" value='draft' <?php if ($post_status == 'draft') {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                <label class="form-check-label" for="draft_radio">
                    Draft
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="post_status" id="published_radio" value="published" <?php if ($post_status == 'published') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                <label class="form-check-label" for="published_radio">
                    Publish
                </label>
            </div>

        </div>
        
        <div class="form-group mb-3">
            <label for="image">Post Image</label><br>
            <img class="my-2" width="100px" src="../images/<?php echo $post_image; ?>" alt="images">
            <input type="file" class="form-control" id="image" name="post_image" value="<?php echo $post_image; ?>">
        </div>

        <div class="form-group mb-3">
            <label for="tags">Post Tag</label>
            <input type="text" class="form-control" id="tags" name="post_tags" value="<?php echo $post_tags; ?>">
        </div>

        <div class="form-group mb-3">
            <label for="editor">Post Content</label>
            <textarea type="text" class="form-control" id="editor" name="post_content" placeholder="Write your content here!"><?php echo $post_content ?></textarea>
        </div>

        <div class="form-group my-4">
            <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
        </div>

    </form>

</div>