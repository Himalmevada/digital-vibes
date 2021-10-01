<div class="col-lg-7 p-0">

    <h4 class="my-3">Add User</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
        </ol>
    </nav>
    <hr>

    <?php
    if (isset($_POST['create_user'])) {

        $username = escape($_POST['username']);
        $user_password = escape($_POST['user_password']);
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        $user_email = escape($_POST['user_email']);
        $user_role = escape($_POST['user_role']);

        if (empty($username) || empty($user_password) || empty($user_email) || empty($user_role)) {

            echo "
            <div class='alert alert-danger' role='alert'>
                All fields are required.
            </div>";
        } else {

            $image_format = ['jpg', 'png', 'jpeg'];
            $file_ext = explode('.', $user_image);
            $file_ext_check = strtolower(end($file_ext));
            $valid_format =  in_array($file_ext_check, $image_format);

            if ($valid_format) {

                move_uploaded_file($user_image_temp, "../images/$user_image");

                global $conn;

                $user_password = password_hash($user_password, PASSWORD_BCRYPT);

                $query = "INSERT INTO users(username, user_password , user_email , user_image , user_role) ";
                $query .= "VALUES('{$username}' , '{$user_password}', '{$user_email}' , '{$user_image}' , '{$user_role}') ";
                $create_user_query = mysqli_query($conn, $query);
                check_query($create_user_query);

                echo "
                <div class='alert alert-success' role='alert'>
                    User added successfully.
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
            <input type="text" class="form-control" id="username" name="username">
        </div>

        <div class="mb-3">
            <label for="image">User Image</label>
            <input type="file" class="form-control" id="image" name="user_image">
        </div>

        <div class="mb-3">
            <label for="user_role">Role</label>
            <select class="form-select" name="user_role" id="user_role">
                <option value='subscriber'>subscriber</option>
                <option value='author'>author</option>
                <option value='admin'>admin</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="author" name="user_email">
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="user_password">
        </div>

        <div class="my-4">
            <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
        </div>

    </form>

</div>