<?php include "include/header.php" ?>
<?php include "include/navigation.php" ?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-4 mt-4" id="form-container">

            <?php

            if (isset($_POST['register_btn'])) {

                $username = escape($_POST['username']);
                $email = escape($_POST['user_email']);
                $password = escape($_POST['user_password']);

                $username = escape($username);
                $email = escape($email);
                $password = escape($password);

                $query = "SELECT * from users";
                $find_user_query = mysqli_query($conn, $query);
                check_query($find_user_query);

                $taken_username = "";

                while ($row = mysqli_fetch_array($find_user_query)) {
                    $taken_username = $row['username'];
                    if ($taken_username == $username) {
                        $taken_username = "taken";
                        break;
                    }
                }

                if ($taken_username == "taken") {
                    echo "
                        <div class='alert alert-warning text-center' role='alert'>
                            Username already taken.
                        </div>";
                } else {

                    $password = password_hash($password, PASSWORD_BCRYPT);

                    $query = "INSERT INTO users (username, user_password, user_email,  user_role) ";
                    $query .= "VALUES ('{$username}', '{$password}', '{$email}', 'subscriber') ";
                    $register_user_query = mysqli_query($conn, $query);
                    if (!$register_user_query) {
                        die("QUERY FAILED" . mysqli_error($conn));
                    }

                    echo "
                        <div class='alert alert-success text-center' role='alert'>
                            You have registered successfully.
                        </div>";
                }
            }

            ?>

            <form class="p-3 form-validation" action="" method="POST" novalidate>

                <h2 class="text-center">Register</h2>
                <hr>

                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" aria-describedby="username_validate" placeholder="Your Username" required>
                    <small id="username_validate" class="invalid-feedback">Enter valid Username.</small>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="user_email" id="email" aria-describedby="email_validate" placeholder="example@gmail.com" required>
                    <small id="email_validate" class="invalid-feedback">Enter valid Email.</small>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="user_password" id="password" aria-describedby="password_validate" placeholder="Your Password" required>
                    <small id="password_validate" class="invalid-feedback">Enter valid password.</small>
                </div>

                <div class="mt-4 text-center">
                    <button class="btn btn-primary w-50" type="submit" name="register_btn">Register</button>
                </div>

            </form>
        </div>

    </div>
</div>



<?php include "include/footer.php" ?>