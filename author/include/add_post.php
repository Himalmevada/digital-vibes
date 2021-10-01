<div class="col-lg-7 p-0" data-editor="ClassicEditor" data-collaboration="false">

    <h4 class="my-3">Add Post</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Post</li>
        </ol>
    </nav>
    <hr>

    <?php
    if (isset($_POST['create_post'])) {

        $post_author = $_SESSION['username'];;
        $post_title = escape($_POST['post_title']);
        $post_category_id = escape($_POST['post_category_id']);
        $post_status = escape($_POST['post_status']);
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_tags = escape($_POST['post_tags']);
        $post_content = escape($_POST['post_content']);
        $post_date = date("dd-mm-yyyy");

        if (empty($post_category_id) || empty($post_title) || empty($post_content) || empty($post_tags) || empty($post_status)) {

            echo "
            <div class='alert alert-danger' role='alert'>
            All fields are required.
            </div>";
        } else {

            $image_format = ['jpg', 'png', 'jpeg'];
            $file_ext = explode('.', $post_image);
            $file_ext_check = strtolower(end($file_ext));
            $valid_format =  in_array($file_ext_check, $image_format);

            if ($valid_format) {

                move_uploaded_file($post_image_temp, "../images/$post_image");

                global $conn;
                $query = "INSERT INTO posts(post_category_id , post_title, post_author, post_date , post_image , post_content , post_tags , post_status) ";
                $query .= "VALUES({$post_category_id} , '{$post_title}', '{$post_author}', now() , '{$post_image}' , '{$post_content}' , '{$post_tags}' , '{$post_status}') ";
                $create_post_query = mysqli_query($conn, $query);
                check_query($create_post_query);

                $post_id = mysqli_insert_id($conn);

                echo "
                        <div class='alert alert-success' role='alert'>
                            Post added successully. <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>Edit More Post</a>
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


    <form class="needs-validation" method="POST" action="" enctype="multipart/form-data" data-editor="DecoupledDocumentEditor" data-collaboration="false" novalidate>

        <div class="mb-3">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" id="title" name="post_title" required>
            <small id="title_validate" class="invalid-feedback">Enter valid post title.</small>
        </div>

        <div class="mb-3">
            <label for="category">Post Category Id</label>
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
                <input class="form-check-input" type="radio" name="post_status" id="draft_radio" value='draft' checked>
                <label class="form-check-label" for="draft_radio">
                    Draft
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="post_status" id="published_radio" value='published'>
                <label class="form-check-label" for="published_radio">
                    Publish
                </label>
            </div>

        </div>

        <div class="mb-3">
            <label for="image">Post Image</label>
            <input type="file" class="form-control" id="image" name="post_image" required>
            <small id="image_validate" class="invalid-feedback">Select valid file.</small>
        </div>

        <div class="mb-3">
            <label for="tags">Post Tag</label>
            <input type="text" class="form-control" id="tags" name="post_tags" required>
            <small id="tags_validate" class="invalid-feedback">Enter post tag.</small>
        </div>

        <div class="mb-3">
            <label for="editor">Post Content</label>
            <textarea type="text" class="form-control" id="editor" name="post_content" placeholder="Write your content here!" required></textarea>
            <!-- <small id="content_validate" class="invalid-feedback">Enter your content.</small> -->
        </div>

        <div class="my-4">
            <button class="btn btn-primary" type="submit" name="create_post" id="add_post_btn">Add Post</button>
        </div>

    </form>
</div>