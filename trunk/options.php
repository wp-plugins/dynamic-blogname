<?php

// Adding Administration Menu

define('DB_PAGE_TITLE', 'Dynamic Blogname Options');

add_action('admin_menu', 'dynamic_blogname_menu');

function dynamic_blogname_menu () {

	add_theme_page( DB_PAGE_TITLE , 'Dynamic Blogname', 'manage_options', __FILE__, 'dynamic_blogname_options');
}

// Options Page

function dynamic_blogname_options() {

	if (!current_user_can( 'manage_options' ) ) {
		wp_die ( __( 'You do not have sufficient permissions to access this page' ) );
	}
	?>
	<div class="wrap">
	<h2> <?php echo DB_PAGE_TITLE ?> </h2>

	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
	<table class="form-table">
	<tr valign="top">
	<th scope="row">Put here titles you want to see as the name of your blog.</th>
	<td><textarea name="o_db_list" class="large-text code" rows="15"><?php echo get_option('o_db_list'); ?></textarea></td>
	</tr>
	</table>
	
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="o_db_list" />	

	<p class="submit"><input type="submit" class="button-primary" value="Save Changes" /></p>

	</form>
	</div>
	<?php
}
?>
