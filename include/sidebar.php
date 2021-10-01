<!-- Side widgets-->
<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        
        <form action="search.php" method="GET">
            <div class="card-header">Search</div>
            <div class="card-body">
                <div class="input-group">
                    <input class="form-control" type="text" name="search_text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                    <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                </div>
            </div>
        </form>

        <!-- Categories widget-->
        <div class="card mb-4">
            
        <?php

        $query = "SELECT * FROM categories";
        $all_categories_sidebar_query = mysqli_query($conn, $query);
        check_query($all_categories_sidebar_query);
        
        ?>

        <div class="card-header">Categories</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-unstyled mb-0">
                        <?php
                        while ($row = mysqli_fetch_assoc($all_categories_sidebar_query)) {
                            $cat_id = escape($row['cat_id']);
                            $cat_title = escape($row['cat_title']);
                        
                            echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Side widget-->
    <?php include "widget.php" ?>
</div>