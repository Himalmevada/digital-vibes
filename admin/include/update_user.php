<div class="col-lg-7 p-0">

    <h4 class="my-3">Update User</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update User</li>
        </ol>
    </nav>
    <hr>

    <?php
    // To show all user details in input form
    if (isset($_GET['update_u_id'])) {
        
        global $conn;
        $user_id = escape($_GET['update_u_id']);

        $query = "SELECT * FROM users WHERE user_id = {$user_id}";
        $get_user_id_query = mysqli_query($conn, $query);

        check_query($get_user_id_query);

        while ($row = mysqli_fetch_assoc($get_user_id_query)) {
            $username = $row['username'];
            $old_user_password = $row['user_password'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
    }

    ?>


    <?php

    // To update all user details in database
    if (isset($_POST['update_user'])) {

        // $username = escape($_POST['username']);
        $user_password = escape($_POST['user_password']);
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        $user_email = escape($_POST['user_email']);
        $user_role = escape($_POST['user_role']);

        if (empty($user_email) || empty($user_role) ) {
            // empty($username) 
            echo "
                <div class='alert alert-danger' role='alert'>
                    All fields are required.
                </div>";
        } else {

            move_uploaded_file($user_image_temp, "../images/$user_image");

            if (empty($user_image)) {
                $query = "SELECT * FROM users WHERE user_id = {$user_id}";
                $get_user_image_query = mysqli_query($conn, $query);
                check_query($get_user_image_query);

                while ($row = mysqli_fetch_assoc($get_user_image_query)) {
                    $user_image =  $row['user_image'];
                }
            }

            $image_format = ['jpg', 'png', 'jpeg'];
            $file_ext = explode('.', $user_image);
            $file_ext_check = strtolower(end($file_ext));
            $valid_format =  in_array($file_ext_check, $image_format);

            if ($valid_format) {

                global $conn;
                if (empty($user_password)) {
                    $user_password = $old_user_password;
                } else {
                    $user_password = password_hash($user_password, PASSWORD_BCRYPT);
                }

                $query = "UPDATE users SET ";
                // $query .= "username = '{$username}', ";
                $query .= "user_password = '{$user_password}', ";
                $query .= "user_email = '{$user_email}', ";
                $query .= "user_image = '{$user_image}', ";
                $query .= "user_role = '{$user_role}' ";
                $query .= "WHERE user_id = {$user_id}";

                $update_user_query = mysqli_query($conn, $query);
                check_query($update_user_query);

                echo "
                <div class='alert alert-success' role='alert'>
                    User updated successfully.
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


    <form method="POST" action="" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" disabled>
        </div>

        <div class="mb-3">
            <label for="image">User Image</label><br>
            <img class="my-2" width="80px" height="auto" src="../images/<?php echo $user_image; ?>" alt="user_image">
            <input type="file" class="form-control" id="image" name="user_image">
        </div>

        <div class="mb-3">
            <label for="user_role">Role</label>
            <select class="form-select" name="user_role" id="user_role">

                <option value='<?php echo $user_role; ?>' selected><?php echo $user_role; ?></option>

                <?php
                if ($user_role == 'admin') {
                    echo "<option value='subscriber'>subscriber</option>";
                    echo "<option value='author'>author</option>";

                } else if($user_role == "author"){
                    echo "<option value='admin'>admin</option>";
                    echo "<option value='subscriber'>subscriber</option>";

                }else{
                    echo "<option value='author'>author</option>";
                    echo "<option value='admin'>admin</option>";
                }
                ?>

            </select>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="user_email" value="<?php echo $user_email; ?>">
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="user_password">
            <small class="text-muted">Your password is encrypted.</small>
        </div>

        <div class="my-4">
            <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
        </div>

    </form>

</div>