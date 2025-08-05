 <?php
function cclw_render_pro_version_page(){ 
    ?>
    <div class="wrap pro_page_design">
        <h1> Pro Version </h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'cclw_pro_version_group' );
            do_settings_sections( 'cclw_pro_version' );
            ?>
        </form>
    </div>
    <?php
}

/**
 * Renders the Pro banner
 */
function cclw_pro_banner_cb() {
    $image = plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'asserts/images/cclw_pro_features.png';
    echo '<div class="cclw_pro_banner">
        <div class="cclw_pro_link">
            <a target="_blank" href="https://blueplugins.com/woocommerce-one-page-checkout-and-layouts-pro/">Try Pro Version</a>
        </div>
        <img src="'. $image .'" alt="Pro Features">
        <div class="cclw_pro_link">
            <a target="_blank" href="https://blueplugins.com/woocommerce-one-page-checkout-and-layouts-pro/">Try Pro Version</a>
        </div>
    </div>';
}