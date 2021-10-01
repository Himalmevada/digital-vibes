<!-- HEADER -->
<?php include "include/admin_header.php" ?>

<!-- NAVIGATION BAR -->
<?php include "include/admin_navigation.php" ?>

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

                case 'add_post':
                    include "include/add_post.php";
                    break;

                case 'update_post':
                    include "include/update_post.php";
                    break;

                default:
                    include "include/show_all_post.php";
                    break;
            }

            ?>

        </div>

    </main>

    <!-- FOOTER -->
    <?php include "include/admin_footer.php"; ?>