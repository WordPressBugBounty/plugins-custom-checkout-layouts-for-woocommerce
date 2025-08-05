<?php 

function cclw_render_settings_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    ?>
   <div class="wrap cclw_form_settings_wrap">
        <h1>Checkout Layouts</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('cclw_general_settings_group'); //  settings page group name
            do_settings_sections('cclw_general_settings');  //  page slug
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function cclw_select_checkout_layouts_cb() {
    $options = get_option('cclw_general_settings');
    $value = $options['checkout_layouts'] ?? 'three-column-layout';
    ?>
    <select name="cclw_general_settings[checkout_layouts]">
        <option value="three-column-layout" <?php selected($value, 'three-column-layout'); ?>>3 Column Layout</option>
        <option value="two-column-layout" <?php selected($value, 'two-column-layout'); ?>>2 Column Layout</option>
        <option value="one-column-layout" <?php selected($value, 'one-column-layout'); ?>>1 Column Layout</option>
        <option value="cart-checkout-layout" <?php selected($value, 'cart-checkout-layout'); ?>>Cart + Checkout Layout</option>
    </select>
    <p class="description">
        (Pro) Want More Layouts? <a target="_blank" href="https://www.youtube.com/watch?v=ODMMvu2xQbw">Video Guide</a>
    </p>
    <?php
}

// Dropdown: Select the order table design style
function cclw_select_order_table_cb() {
    $options = get_option('cclw_general_settings');
    $value = $options['checkout_ordertable'] ?? 'basic-table';
    ?>
    <select name="cclw_general_settings[checkout_ordertable]">
        <option value="style-1" <?php selected($value, 'style-1'); ?>>Style 1</option>  <!-- Custom style -->
        <option value="style-default" <?php selected($value, 'style-default'); ?>>Default Style</option>  <!-- WooCommerce default style -->
    </select>
    <p class="description">Select a design for the Order Review table.</p>
    <?php
}

// Radio buttons: Skip cart page? Yes/No
function cclw_radio_skip_cart_cb() {
    $options = get_option('cclw_general_settings');
    $value = $options['skip_cart'] ?? 'yes';
    ?>
    <label><input type="radio" name="cclw_general_settings[skip_cart]" value="yes" <?php checked($value, 'yes'); ?>> Yes</label>
    <label><input type="radio" name="cclw_general_settings[skip_cart]" value="no" <?php checked($value, 'no'); ?>> No</label>
    <p class="description">Recommended "yes". Skip cart page to shorten the checkout process.</p>
    <?php
}

// Radio buttons: Make quantity non-changeable? Yes/No
function cclw_radio_skip_qty_cb() {
    $options = get_option('cclw_general_settings');
    $value = $options['skip_qty'] ?? 'no';
    ?>
    <label><input type="radio" name="cclw_general_settings[skip_qty]" value="yes" <?php checked($value, 'yes'); ?>> Yes</label>
    <label><input type="radio" name="cclw_general_settings[skip_qty]" value="no" <?php checked($value, 'no'); ?>> No</label>
    <p class="description">Prevent buyers from changing quantity at checkout. Useful if selling only one item.</p>
    <?php
}

// Radio buttons: Hide order notes section? Yes/No
function cclw_radio_order_notes_cb() {
    $options = get_option('cclw_general_settings');
    $value = $options['order_notes'] ?? 'no';
    ?>
    <label><input type="radio" name="cclw_general_settings[order_notes]" value="yes" <?php checked($value, 'yes'); ?>> Yes</label>
    <label><input type="radio" name="cclw_general_settings[order_notes]" value="no" <?php checked($value, 'no'); ?>> No</label>
    <p class="description">Select "yes" to hide the Order Notes section from checkout.</p>
    <?php
}

			?>