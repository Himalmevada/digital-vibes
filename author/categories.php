<!-- HEADER -->
<?php include "include/author_header.php" ?>

<!-- NAVIGATION BAR -->
<?php include "include/author_navigation.php" ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 ">
            <h4 class="my-3">All Categories</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Categories</li>
                </ol>
            </nav>
            <hr>

            <div class="row">
                <div class="col-sm-6 table-responsive">
                    <table class="table table-hover table-bordered">

                        <thead>
                            <tr class="table-dark">
                                <th scope="col">Category Id</th>
                                <th scope="col">Category Title</th>
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
                                echo "</tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <?php include "include/author_footer.php"; ?>