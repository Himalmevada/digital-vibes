<?php include "include/header.php"; ?>
<?php include "include/navigation.php"; ?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-4 mt-4" id="form-container">

            <?php
            
            ob_start();
            session_start();

            if (isset($_POST['login'])) {

                global $conn;
                $email = escape($_POST['email']);
                $password = escape($_POST['password']);
                $author = "author";

                $email = escape($email);
                $password = escape($password);

                $query = "SELECT * FROM users WHERE user_email = '{$email}' AND user_role = '{$author}'";
                $select_user_query = mysqli_query($conn, $query);
                check_query($select_user_query);
                
                $db_user_password = "";
                $db_user_email = "";

                while ($row = mysqli_fetch_array($select_user_query)) {
                    $db_user_id = $row['user_id'];
                    $db_username = $row['username'];
                    $db_user_email = $row['user_email'];
                    $db_user_password = $row['user_password'];
                    $db_user_image = $row['user_image'];
                    $db_user_role = $row['user_role'];
                }


                $password_check = password_verify($password, $db_user_password);

                if ($db_user_email === $email && $password_check && $db_user_role === $author) {

                    $_SESSION['username'] = $db_username;
                    $_SESSION['user_email'] = $db_user_email;
                    $_SESSION['user_image'] = $db_user_image;
                    $_SESSION['user_role'] = $db_user_role;
                    $_SESSION['session_time'] = time();

                    header("Location: author/index.php");

                }
                else{
                    echo "
                        <div class='alert alert-danger text-center' role='alert'>
                            Invalid Email or Password.
                        </div>";
                }
            }

            ?>

            <form class="p-3 form-validation" action="" method="POST" novalidate>

                <h2 class="text-center">Author Login</h2>
                <hr>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="email_validate" placeholder="Your Email" required>
                    <small id="email_validate" class="invalid-feedback">Enter valid email.</small>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="password_validate" placeholder="Your Password" required>
                    <small id="password_validate" class="invalid-feedback">Enter valid password.</small>
                </div>

                <div class="mt-4 text-center">
                    <button class="btn btn-primary w-50" type="submit" name="login">Login</button>
                </div>

            </form>
        </div>

    </div>
</div>

<?php include "include/footer.php" ?>