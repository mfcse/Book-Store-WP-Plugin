<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Book Store', 'book-store'); ?></h1>
    <?php if (isset($_GET['inserted'])) { ?>
    <div class="notice notice-success">
        <?php _e('Book has been added', 'book-store') ?>
    </div>
    <?php }  ?>
    <?php if (isset($_GET['book-deleted'])) { ?>
    <div class="notice notice-success">
        <?php _e('Book has been Deleted Successfully', 'book-store')
            ?>
    </div>
    <?php }  ?>
    <a href="<?php echo admin_url('admin.php?page=book-store&action=new'); ?>"
        class="page-title-action"><?php _e('Add New', 'book-store'); ?></a>


    <form action="" method="post">
        <?php
        $table = new \Book\Store\Admin\Book_List();
        $table->prepare_items();
        $table->display();
        ?>
    </form>
</div>