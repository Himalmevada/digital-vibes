<!-- HEADER -->
<?php include "include/author_header.php"; ?>

<?php

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_profile_query = mysqli_query($conn, $query);
    check_query($select_user_profile_query);

    while ($row = mysqli_fetch_assoc($select_user_profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $old_user_password = $row['user_password'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

?>



<!-- NAVIGATION BAR -->
<?php include "include/author_navigation.php"; ?>


<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid px-4">

            <div class="col-lg-7 p-0">

                <h4 class="my-3 text-capitalize"><span class="text-primary"><?php echo $_SESSION['username'] . "'s"; ?></span>
                    Profile
                </h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $_SESSION['username'] . "'s"; ?> Profile</li>
                    </ol>
                </nav>

                <hr>
                
                <!-- QUERY TO UPDATE PROFILE -->
                
                <?php

                // To update all user details in database
                if (isset($_POST['update_profile'])) {

                    // $username = escape($_POST['username']);
                    $user_password = escape($_POST['user_password']);
                    $user_image = $_FILES['user_image']['name'];
                    $user_image_temp = $_FILES['user_image']['tmp_name'];
                    $user_email = escape($_POST['user_email']);

                    if (empty($user_email)) {
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
                            $query  =  "UPDATE users SET ";
                            // $query .= "username = '{$username}', ";
                            $query .= "user_password = '{$user_password}', ";
                            $query .= "user_email = '{$user_email}', ";
                            $query .= "user_image = '{$user_image}' ";
                            $query .= "WHERE user_id = {$user_id}";

                            $update_user_query = mysqli_query($conn, $query);
                            check_query($update_user_query);

                            echo "
                            <div class='alert alert-success' role='alert'>
                                Profile updated successfully.
                            </div>";

                            $_SESSION['username'] = $username;
                            $_SESSION['user_email'] = $user_email;
                            $_SESSION['user_image'] = $user_image;
                            $_SESSION['user_role'] = $user_role;
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
                        <img class="my-2" width="80px" height="auto" src="../images/<?php echo $user_image; ?>" alt="images">
                        <input type="file" class="form-control" id="image" name="user_image">
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="author" name="user_email" value="<?php echo $user_email; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="user_password"">
                        <small class=" text-muted">Your password is encrypted.</small>
                    </div>

                    <div class=" my-4">
                        <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                    </div>

                </form>

            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <?php include 'include/author_footer.php'; ?>