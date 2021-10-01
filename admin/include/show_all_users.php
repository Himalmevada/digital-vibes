<h4 class="my-3">All Users</h4>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">All User</li>
    </ol>
</nav>
<hr>

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr class="table-dark">
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Image</th>
                <th scope="col">Role</th>
                <th class="text-center" scope="col" colspan="3">Change Role</th>
                <th class="text-center" scope="col" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php

            global $conn;
            $query = "SELECT * FROM users";
            $select_all_users_query = mysqli_query($conn, $query);
            check_query($select_all_users_query);

            while ($row = mysqli_fetch_assoc($select_all_users_query)) {

                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];

                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$user_email</td>";
                echo "<td class='text-center'><img width='50px' height='auto' src='../images/$user_image' alt='user_image'></td>";
                echo "<td>$user_role</td>";
                echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-primary' href='users.php?to_admin={$user_id}'>Admin</td>";
                echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-primary' href='users.php?to_author={$user_id}'>Author</td>";
                echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-primary' href='users.php?to_sub={$user_id}'>Subscriber</td>";
                echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-success' href='users.php?source=update_user&update_u_id={$user_id}'><i class='fas fa-edit'></i> Edit</td>";
                echo "<td class='text-center text-nowrap'><a class='btn btn-sm btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='users.php?delete={$user_id}'><i class='fas fa-trash-alt'></i> Delete</td>";
                echo "</tr>";
            }
            ?>
        </tbody>

    </table>

</div>


<!-- DELETE USER QUERY -->

<?php
if (isset($_GET['delete'])) {
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == "admin"){

            $user_id = escape($_GET['delete']);
            $query = "DELETE FROM users WHERE user_id = $user_id";
            $delete_user_query = mysqli_query($conn, $query);
            check_query($delete_user_query);
            header("Location: users.php");
        }
    }
}
?>

<!-- TO ADMIN QUERY -->

<?php
if (isset($_GET['to_admin'])) {
    $user_id = escape($_GET['to_admin']);
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id";
    $change_to_admin_query = mysqli_query($conn, $query);
    check_query($change_to_admin_query);
    header("Location: users.php");
}
?>

<!-- TO AUTHOR QUERY -->

<?php
if (isset($_GET['to_author'])) {
    $user_id = escape($_GET['to_author']);
    $query = "UPDATE users SET user_role = 'author' WHERE user_id = $user_id";
    $change_author_query = mysqli_query($conn, $query);
    check_query($change_author_query);
    header("Location: users.php");
}
?>

<!-- TO SUBSCRIBER QUERY -->

<?php
if (isset($_GET['to_sub'])) {
    $user_id = escape($_GET['to_sub']);
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $user_id";
    $change_to_sub_query = mysqli_query($conn, $query);
    check_query($change_to_sub_query);
    header("Location: users.php");
}
?>