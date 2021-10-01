<!-- HEADER -->
<?php include "include/admin_header.php" ?>

<!-- NAVIGATION BAR -->
<?php include "include/admin_navigation.php" ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 ">
            <h4 class="my-3">Manage Categories</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Categories</li>
                </ol>
            </nav>
            <hr>

            <div class="row">

                <div class="col-sm-6 mt-2">

                    <form action="" method="POST">

                        <!-- CREATE CATEGORY QUERY -->
                        <?php 
                        
                        global $conn;
                        if (isset($_POST['add_submit'])) {
                            $cat_title = escape($_POST['cat_title']);

                            if (!$cat_title || empty($cat_title)) {

                                echo "
                                <div class='alert alert-danger' role='alert'>
                                This field should not be empty.
                                </div>";

                            } else {
                                $query = "INSERT INTO categories(cat_title) ";
                                $query .= "VALUES('$cat_title')";

                                $create_category_query = mysqli_query($conn, $query);
                                check_query($create_category_query);
                            }
                        }
                        
                        ?>

                        <div class="mb-3">
                            <label class="mb-2" for="title">Add Category</label>
                            <input type="text" class="form-control" id="title" name="cat_title" placeholder="Category Name">
                        </div>

                        <div class="mb-3">
                            <input class="btn btn-primary" type="submit" name="add_submit" value="Add Category">
                        </div>

                    </form>


                    <!-- UPDATE AND INCLUDE QUERY -->
                    <?php
                    if (isset($_GET['update'])) {

                        $cat_id = escape($_GET['update']);

                        include "include/update_categories.php";
                    }
                    ?>

                </div>

                <div class="col-sm-6 table-responsive">
                    <table class="table table-hover table-bordered">

                        <thead>
                            <tr class="table-dark">
                                <th scope="col">Category Id</th>
                                <th scope="col">Category Title</th>
                                <th scope="col" colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <!-- FIND ALL CATEGORIES QUERY -->
                            <?php 
                            
                            global $conn;
                            $query = "SELECT * FROM categories";
                            $select_all_categories_query = mysqli_query($conn, $query);
                            check_query($select_all_categories_query);
                        
                        
                            while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                        
                                echo "<tr>";
                                echo "<td>{$cat_id}</td>";
                                echo "<td>{$cat_title}</td>";
                                echo "<td class='text-center'><a class='btn btn-sm btn-success' href='categories.php?update={$cat_id}'><i class='fas fa-edit'></i> Edit</td>";
                                echo "<td class='text-center'><a class='btn btn-sm btn-danger' onClick=\"javascript: return confirm('It will also delete your all post related to this category.');\"  href='categories.php?delete={$cat_id}'><i class='fas fa-trash-alt'></i> Delete</td>";
                                echo "</tr>";
                            }

                            ?>


                            <!-- DELETE CATEGORY QUERY -->
                            <?php 
                                global $conn;
                                if (isset($_GET['delete'])) {
                                    $cat_id = escape($_GET['delete']);
                                    $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
                                    $delete_category_query = mysqli_query($conn, $query);
                                    check_query($delete_category_query);
                                    header("Location: categories.php");
                                }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <?php include "include/admin_footer.php"; ?>