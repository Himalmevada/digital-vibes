<!-- GET CATEGORY QUERY -->
<form class="mt-4" action="" method="POST">

    <?php

    // UPDATE CATEGORIES QUERY
    if (isset($_GET['update']) && isset($_POST['update_cat'])) {
        $cat_id = escape($_GET['update']);
        $update_cat_title = escape($_POST['cat_title']);
        if (!empty($update_cat_title)) {

            $query = "UPDATE categories SET cat_title = '$update_cat_title' WHERE cat_id = $cat_id";
            $update_category_query = mysqli_query($conn, $query);
            if (!$update_category_query) {
                die('QUERY FAILED' . mysqli_error($conn));
            }
            header('Location: categories.php');
        } else {
            echo "
                <div class='alert alert-danger' role='alert'>
                    This field should not be empty.
                </div>";
        }
    }

    ?>

    <div class="mb-3">
        <label class="mb-2" for="title">Edit Category</label>
        <?php

        if (isset($_GET['update'])) {
            $cat_id = escape($_GET['update']);
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $get_category_id_query = mysqli_query($conn, $query);
            if (!$get_category_id_query) {
                die("QUERY FAILED" . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($get_category_id_query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
        ?>
                <input type="text" class="form-control" id="title" name="cat_title" value="<?php if (isset($cat_title)) { echo $cat_title;} ?>">
      <?php
            }
        }

        ?>
    </div>

    <div class="mb-3">
        <input class="btn btn-primary" type="submit" name="update_cat" value="Update Category">
    </div>

</form>