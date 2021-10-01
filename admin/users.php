<!-- HEADER -->
<?php include "include/admin_header.php";?>

<!-- NAVIGATION BAR -->
<?php include "include/admin_navigation.php";?>

<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4">

            <?php

                if (isset($_GET['source'])) {
                    $source = escape($_GET['source']);
                } else {
                    $source = '';
                }

                switch ($source) {

                    case 'add_user':
                        include "include/add_user.php";
                        break;

                    case 'update_user':
                        include "include/update_user.php";
                        break;

                    default:
                        include "include/show_all_users.php";
                        break;
                }

            ?>

        </div>

    </main>

<!-- FOOTER -->
<?php include 'include/admin_footer.php';?>