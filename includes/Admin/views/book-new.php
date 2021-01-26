<div class="wrap">
    <h1><?php _e('New Book', 'book-store'); ?></h1>


    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row<?php echo $this->has_error('name') ? ' form-invalid' : ''; ?> ">
                    <th scope="row">
                        <label for="name"><?php _e('Name', 'book-store'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="">
                        <?php if ($this->has_error('name')) { ?>
                        <p class="description error"><?php echo $this->get_error('name'); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description"><?php _e('Description', 'book-store'); ?></label>
                    </th>
                    <td>
                        <textarea class="regular-text" name="description" id="description"></textarea>
                    </td>
                </tr>
                <tr class="row<?php echo $this->has_error('author') ? ' form-invalid' : ''; ?> ">
                    <th scope="row">
                        <label for="author"><?php _e('Author', 'book-store'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="author" id="author" class="regular-text" value="">
                        <?php if ($this->has_error('author')) { ?>
                        <p class="description error"><?php echo $this->get_error('author'); ?></p>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php wp_nonce_field('new-book'); ?>
        <?php submit_button(__('Add Book', 'book-store'), 'primary', 'submit_book'); ?>
    </form>
</div>