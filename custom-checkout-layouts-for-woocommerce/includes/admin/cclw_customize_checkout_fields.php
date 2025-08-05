<?php 
/*function is called under admin submenu*/
function cclw_render_customize_checkout_fields_page() {
    ?>
     <div class="wrap cclw_form_settings_wrap acc_design">
	 <h1>Customize checkout settings</h1>
     <h2 class="nav-tab-wrapper">
        <a href="#" class="nav-tab nav-tab-active" data-tab="billing">Billing</a>
        <a href="#" class="nav-tab" data-tab="shipping">Shipping</a>
     </h2>

    <form method="post" action="options.php">
    <?php settings_fields('cclw_customize_checkout_fields_group'); ?>
    <?php //do_settings_sections('cclw_checkout_fields_top'); // optional override toggle section ?>

    <div id="cclw_billing_fields" class="cclw-tab-content">
        <?php
            cclw_overide_fields_cb();
            cclw_billing_first_name_cb();
            cclw_billing_last_name_cb();
            cclw_billing_company_cb();
            cclw_billing_country_cb();
            cclw_billing_address_1_cb();
            cclw_billing_address_2_cb();
            cclw_billing_city_cb();
            cclw_billing_state_cb();
            cclw_billing_postcode_cb();
            cclw_billing_phone_cb();
            cclw_billing_email_cb();
        ?>
    </div>

    <div id="cclw_shipping_fields" class="cclw-tab-content" style="display:none;">
        <?php
            cclw_shipping_first_name_cb();
            cclw_shipping_last_name_cb();
            cclw_shipping_country_cb();
            cclw_shipping_address_1_cb();
            cclw_shipping_address_2_cb();
            cclw_shipping_city_cb();
            cclw_shipping_state_cb();
            cclw_shipping_postcode_cb();
        ?>
    </div>

    <?php submit_button(); ?>
</form>

    </div>

    <?php } 
	
function cclw_overide_fields_cb() {

    $options = get_option('cclw_checkout_fields');
    $value = $options['cclw_overide_fields'] ?? 'no';

    echo '<div class="cclw-ad-field-group">';

    // Radio Buttons: Yes / No
    echo '<div class="cclw-ad-field-row ">';
    echo '<label class="cclw-ad-field-label">Override Checkout Fields?</label>';
    echo '<div>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_overide_fields]" value="yes" ' . checked($value, 'yes', false) . '> Yes</label> ';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_overide_fields]" value="no" ' . checked($value, 'no', false) . '> No</label>';
    echo '</div>';
    echo '</div>'; // End field-row

    // Description
    echo '<div class="cclw-ad-field-row">';
    echo '<p class="description">Recommended to select <strong>No</strong> if you are using any external plugin for Billing/Shipping Fields (e.g., Custom Fields for WooCommerce). The below setting panel will only work if you select <strong>Yes</strong>.</p>';
    echo '</div>'; // End field-row

    echo '</div>'; // End field-group
}


function cclw_billing_first_name_cb() {
    echo '<div class="cclw-field-group">';
	echo '<h2 class="wp-accordion">Billing First Name</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_billing_first_name']) ? $options['cclw_billing_first_name'] : array(
        'slug'        => 'first_name',
        'label'       => 'First Name',
        'type'        => 'billing',
        'placeholder' => '',
        'width'       => 'form-row-first',
        'required'    => 'true',
        'show_hide'   => 'show',
    );
	

	echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden Slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_first_name][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_first_name][type]" value="' . esc_attr($value['type']) . '" />';

    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="billing_label" class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" id="billing_label" name="cclw_checkout_fields[cclw_billing_first_name][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="First Name">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="billing_placeholder" class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" id="billing_placeholder" name="cclw_checkout_fields[cclw_billing_first_name][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input" placeholder="Enter your First Name">';
    echo '</div>';

    // Width
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Width</label>';
    echo '<div>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_first_name][width]" value="form-row-first" ' . checked($value['width'], 'form-row-first', false) . '> 50% Left</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_first_name][width]" value="form-row-last" ' . checked($value['width'], 'form-row-last', false) . '> 50% Right</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_first_name][width]" value="form-row-wide" ' . checked($value['width'], 'form-row-wide', false) . '> Full Width</label>';
    echo '</div>';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<div>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_first_name" name="cclw_checkout_fields[cclw_billing_first_name][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_first_name" name="cclw_checkout_fields[cclw_billing_first_name][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_billing_first_name">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<div>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_first_name][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_first_name][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>'; // End field group
}

// billing last name 
function cclw_billing_last_name_cb() {
    echo '<div class="cclw-field-group">';
	echo '<h2 class="wp-accordion">Billing Last Name</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_billing_last_name']) ? $options['cclw_billing_last_name'] : array(
        'slug'        => 'last_name',
        'label'       => 'Last Name',
        'type'        => 'billing',
        'placeholder' => '',
        'width'       => 'form-row-last',
        'required'    => 'true',
        'show_hide'   => 'show',
    );
    

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden Slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_last_name][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_last_name][type]" value="' . esc_attr($value['type']) . '" />';

    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="billing_last_label" class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" id="billing_last_label" name="cclw_checkout_fields[cclw_billing_last_name][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Last Name">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="billing_last_placeholder" class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" id="billing_last_placeholder" name="cclw_checkout_fields[cclw_billing_last_name][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input" placeholder="Enter your Last Name">';
    echo '</div>';

    // Width
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Width</label>';
    echo '<div>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_last_name][width]" value="form-row-first" ' . checked($value['width'], 'form-row-first', false) . '> 50% Left</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_last_name][width]" value="form-row-last" ' . checked($value['width'], 'form-row-last', false) . '> 50% Right</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_last_name][width]" value="form-row-wide" ' . checked($value['width'], 'form-row-wide', false) . '> Full Width</label>';
    echo '</div>';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<div>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_last_name" name="cclw_checkout_fields[cclw_billing_last_name][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_last_name" name="cclw_checkout_fields[cclw_billing_last_name][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_billing_last_name">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<div>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_last_name][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_last_name][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>'; // End field group
}

//function to call company field
function cclw_billing_company_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Billing Company</h2>';

    $options = get_option('cclw_checkout_fields');
    $value = isset($options['cclw_billing_company']) ? $options['cclw_billing_company'] : array(
        'slug'        => 'company',
        'label'       => 'Company',
        'type'        => 'billing',
        'placeholder' => 'Enter your Company Name',
        'width'       => 'form-row-wide',
        'required'    => 'false',
        'show_hide'   => 'show',
        'priority' => 30,
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden Slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_company][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_company][type]" value="' . esc_attr($value['type']) . '" />';

    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="billing_company_label" class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" id="billing_company_label" name="cclw_checkout_fields[cclw_billing_company][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Company">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="billing_company_placeholder" class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" id="billing_company_placeholder" name="cclw_checkout_fields[cclw_billing_company][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input" placeholder="Enter your Company Name">';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<div>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_company" name="cclw_checkout_fields[cclw_billing_company][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_company" name="cclw_checkout_fields[cclw_billing_company][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_billing_company">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<div>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_company][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_company][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>'; // End group
}

/*billing country callback*/
function cclw_billing_country_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Billing Country / Region</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_billing_country']) ? $options['cclw_billing_country'] : array(
        'slug'        => 'country',
        'label'       => 'Country / Region',
        'type'        => 'billing',
        'placeholder' => '',
        'required'    => 'false',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_country][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_country][type]" value="' . esc_attr($value['type']) . '" />';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_country][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="State/Country">';
    echo '</div>';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_country][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_country" name="cclw_checkout_fields[cclw_billing_country][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_country" name="cclw_checkout_fields[cclw_billing_country][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_billing_country">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_country][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_country][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
     echo '</div>';
    echo '</div>';
}
/*Street adress 1*/
function cclw_billing_address_1_cb() {
     echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Street Address (Address Line 1)</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_billing_address_1']) ? $options['cclw_billing_address_1'] : array(
        'slug'        => 'address_1',
        'label'       => 'Street address',
        'type'        => 'billing',
        'placeholder' => 'House number and street name',
        'required'    => 'true',
        'show_hide'   => 'show',
    );
//print_r($value);
    echo '<div class="cclw-ad-field-group wp-panel">';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_address_1][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_address_1][type]" value="' . esc_attr($value['type']) . '" />';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_address_1][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Street address">';
    echo '</div>';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_address_1][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_address_1" name="cclw_checkout_fields[cclw_billing_address_1][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_address_1" name="cclw_checkout_fields[cclw_billing_address_1][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_billing_address_1">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_address_1][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_address_1][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
     echo '</div>';
    echo '</div>';
}
/*street field 3*/
function cclw_billing_address_2_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Street Address (Address Line 2)</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_billing_address_2']) ? $options['cclw_billing_address_2'] : array(
        'slug'        => 'address_2',
         'type'        => 'billing',
        'placeholder' => 'Apartment, suite, unit, etc. (optional)',
        'required'    => 'false',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_address_2][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_address_2][type]" value="' . esc_attr($value['type']) . '" />';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_address_2][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input" placeholder="Apartment, suite, unit, etc. (optional)">';
    echo '</div>';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_address_2" name="cclw_checkout_fields[cclw_billing_address_2][required]" value="true" ' . checked($value['required'], 'true', false) . '>Yes </label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_address_2" name="cclw_checkout_fields[cclw_billing_address_2][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_billing_address_2">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_address_2][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_address_2][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
/*billing city*/
function cclw_billing_city_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Billing Town / City</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_billing_city']) ? $options['cclw_billing_city'] : array(
        'slug'        => 'city',
        'label'       => 'Town/City',
        'type'        => 'billing',
        'placeholder' => '',
        'required'    => 'true',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_city][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_city][type]" value="' . esc_attr($value['type']) . '" />';

    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_city][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Town/City">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_city][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_city" name="cclw_checkout_fields[cclw_billing_city][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_city" name="cclw_checkout_fields[cclw_billing_city][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_billing_city">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_city][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_city][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>'; // 
    echo '</div>';
}
/*billing state*/
function cclw_billing_state_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Billing State / Country</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_billing_state']) ? $options['cclw_billing_state'] : array(
        'slug'        => 'state',
        'label'       => 'State/Country',
        'type'        => 'billing',
        'placeholder' => '',
        'required'    => 'true',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_state][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_state][type]" value="' . esc_attr($value['type']) . '" />';
    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_state][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="State/Country">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_state][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_state" name="cclw_checkout_fields[cclw_billing_state][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_state" name="cclw_checkout_fields[cclw_billing_state][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_billing_state">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_state][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_state][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>'; 
    echo '</div>';
}

/*billing pincode section*/
function cclw_billing_postcode_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Billing Postcode / ZIP</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_billing_postcode']) ? $options['cclw_billing_postcode'] : array(
        'slug'        => 'postcode',
        'label'       => 'Postcode / ZIP',
        'type'        => 'billing',
        'placeholder' => '',
        'required'    => 'true',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden Slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_postcode][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_postcode][type]" value="' . esc_attr($value['type']) . '" />';
    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_postcode][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Postcode / ZIP">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_postcode][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_postcode" name="cclw_checkout_fields[cclw_billing_postcode][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_postcode" name="cclw_checkout_fields[cclw_billing_postcode][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_billing_postcode">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_postcode][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_postcode][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>'; 
    echo '</div>';
}
/*billing phone section*/
function cclw_billing_phone_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Billing Phone</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_billing_phone']) ? $options['cclw_billing_phone'] : array(
        'slug'        => 'phone',
        'label'       => 'Phone',
        'type'        => 'billing',
        'placeholder' => '',
        'required'    => 'true',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden Slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_phone][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_phone][type]" value="' . esc_attr($value['type']) . '" />';

    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_phone][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Phone">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_phone][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_phone" name="cclw_checkout_fields[cclw_billing_phone][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_billing_phone" name="cclw_checkout_fields[cclw_billing_phone][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_billing_phone">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_phone][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_phone][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>'; // 
    echo '</div>';
}
/*Billing email*/
function cclw_billing_email_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Billing Email</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_billing_email']) ? $options['cclw_billing_email'] : array(
        'slug'        => 'email',
        'label'       => 'Email',
        'type'        => 'billing',
        'placeholder' => '',
        'required'    => 'true',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden Slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_email][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_billing_email][type]" value="' . esc_attr($value['type']) . '" />';

    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_email][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Email">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_billing_email][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_email][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_billing_email][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';
    echo '</div>'; // 
    echo '</div>';
}


function cclw_shipping_first_name_cb() {
    echo '<div class="cclw-field-group">';
	echo '<h2 class="wp-accordion">Shipping First Name</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_shipping_first_name']) ? $options['cclw_shipping_first_name'] : array(
        'slug'        => 'first_name',
        'label'       => 'First Name',
        'type'        => 'shipping',
        'placeholder' => '',
        'width'       => 'form-row-first',
        'required'    => 'true',
        'show_hide'   => 'show',
    );
   
	echo '<div class="cclw-ad-field-group wp-panel shipping-first-tab">';

    // Hidden Slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_first_name][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_first_name][type]" value="' . esc_attr($value['type']) . '" />';
    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="shipping_label" class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" id="shipping_label" name="cclw_checkout_fields[cclw_shipping_first_name][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="First Name">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="shipping_placeholder" class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" id="shipping_placeholder" name="cclw_checkout_fields[cclw_shipping_first_name][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input" placeholder="Enter your First Name">';
    echo '</div>';

    // Width
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Width</label>';
    echo '<div>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_first_name][width]" value="form-row-first" ' . checked($value['width'], 'form-row-first', false) . '> 50% Left</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_first_name][width]" value="form-row-last" ' . checked($value['width'], 'form-row-last', false) . '> 50% Right</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_first_name][width]" value="form-row-wide" ' . checked($value['width'], 'form-row-wide', false) . '> Full Width</label>';
    echo '</div>';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<div>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_first_name" name="cclw_checkout_fields[cclw_shipping_first_name][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_first_name" name="cclw_checkout_fields[cclw_shipping_first_name][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_shipping_first_name">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<div>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_first_name][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_first_name][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>';
    echo '</div>'; // 
    echo '</div>'; // End field group
}


// shipping last name 
function cclw_shipping_last_name_cb() {
    echo '<div class="cclw-field-group">';
	echo '<h2 class="wp-accordion">Shipping Last Name</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_shipping_last_name']) ? $options['cclw_shipping_last_name'] : array(
        'slug'        => 'last_name',
        'label'       => 'Last Name',
        'type'        => 'shipping',
        'placeholder' => '',
        'width'       => 'form-row-last',
        'required'    => 'true',
        'show_hide'   => 'show',
    );
    

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden Slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_last_name][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_last_name][type]" value="' . esc_attr($value['type']) . '" />';
    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="shipping_last_label" class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" id="shipping_last_label" name="cclw_checkout_fields[cclw_shipping_last_name][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Last Name">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="shipping_last_placeholder" class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" id="shipping_last_placeholder" name="cclw_checkout_fields[cclw_shipping_last_name][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input" placeholder="Enter your Last Name">';
    echo '</div>';

    // Width
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Width</label>';
    echo '<div>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_last_name][width]" value="form-row-first" ' . checked($value['width'], 'form-row-first', false) . '> 50% Left</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_last_name][width]" value="form-row-last" ' . checked($value['width'], 'form-row-last', false) . '> 50% Right</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_last_name][width]" value="form-row-wide" ' . checked($value['width'], 'form-row-wide', false) . '> Full Width</label>';
    echo '</div>';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<div>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_last_name" name="cclw_checkout_fields[cclw_shipping_last_name][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_last_name" name="cclw_checkout_fields[cclw_shipping_last_name][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_shipping_last_name">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<div>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_last_name][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_last_name][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>';
    echo '</div>'; // 
    echo '</div>'; // End field group
}

/*shipping country callback*/
function cclw_shipping_country_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Shipping Country / Region</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_shipping_country']) ? $options['cclw_shipping_country'] : array(
        'slug'        => 'country',
        'label'       => 'Country / Region',
        'type'        => 'shipping',
        'placeholder' => '',
        'required'    => 'true',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_country][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_country][type]" value="' . esc_attr($value['type']) . '" />';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_country][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="State/Country">';
    echo '</div>';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_country][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_country" name="cclw_checkout_fields[cclw_shipping_country][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_country" name="cclw_checkout_fields[cclw_shipping_country][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_shipping_country">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_country][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_country][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>'; 
    echo '</div>';
}
/*Street adress 1*/
function cclw_shipping_address_1_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Street Address (Address Line 1)</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_shipping_address_1']) ? $options['cclw_shipping_address_1'] : array(
        'slug'        => 'address_1',
        'type'        => 'shipping',
        'label'       => 'Street address',
        'placeholder' => 'House number and street name',
        'required'    => 'true',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_address_1][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_address_1][type]" value="' . esc_attr($value['type']) . '" />';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_address_1][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Street address">';
    echo '</div>';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_address_1][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_address_1" name="cclw_checkout_fields[cclw_shipping_address_1][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_address_1" name="cclw_checkout_fields[cclw_shipping_address_1][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_shipping_address_1">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_address_1][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_address_1][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>'; 
    echo '</div>';
}
/*street field 3*/
function cclw_shipping_address_2_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Street Address (Address Line 2)</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_shipping_address_2']) ? $options['cclw_shipping_address_2'] : array(
        'slug'        => 'address_2',
        'type'        => 'shipping',
        'placeholder' => 'Apartment, suite, unit, etc. (optional)',
        'required'    => 'false',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_address_2][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_address_2][type]" value="' . esc_attr($value['type']) . '" />';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_address_2][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input" placeholder="Apartment, suite, unit, etc. (optional)">';
    echo '</div>';

    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_address_2" name="cclw_checkout_fields[cclw_shipping_address_2][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_address_2" name="cclw_checkout_fields[cclw_shipping_address_2][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_shipping_address_2">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_address_2][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_address_2][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>'; 
    echo '</div>';
}
/*shipping city*/
function cclw_shipping_city_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Shipping Town / City</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_shipping_city']) ? $options['cclw_shipping_city'] : array(
        'slug'        => 'city',
        'label'       => 'Town/City',
        'type'        => 'shipping',
        'placeholder' => '',
        'required'    => 'true',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_city][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_city][type]" value="' . esc_attr($value['type']) . '" />';

    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_city][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Town/City">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_city][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_city" name="cclw_checkout_fields[cclw_shipping_city][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_city" name="cclw_checkout_fields[cclw_shipping_city][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_shipping_city">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_city][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_city][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>'; 
    echo '</div>';
}
/*shipping state*/
function cclw_shipping_state_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Shipping State / Country</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_shipping_state']) ? $options['cclw_shipping_state'] : array(
        'slug'        => 'state',
        'label'       => 'State/Country',
        'type'        => 'shipping',
        'placeholder' => '',
        'required'    => 'true',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_state][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_state][type]" value="' . esc_attr($value['type']) . '" />';

    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_state][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="State/Country">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_state][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_state" name="cclw_checkout_fields[cclw_shipping_state][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_state" name="cclw_checkout_fields[cclw_shipping_state][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_shipping_state">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_state][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_state][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>';  
    echo '</div>';
}

/*shipping pincode section*/
function cclw_shipping_postcode_cb() {
    echo '<div class="cclw-field-group">';
    echo '<h2 class="wp-accordion">Shipping Postcode / ZIP</h2>';
    $options = get_option('cclw_checkout_fields');

    $value = isset($options['cclw_shipping_postcode']) ? $options['cclw_shipping_postcode'] : array(
        'slug'        => 'postcode',
        'label'       => 'Postcode / ZIP',
        'type'        => 'shipping',
        'placeholder' => '',
        'required'    => 'true',
        'show_hide'   => 'show',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Hidden Slug
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_postcode][slug]" value="' . esc_attr($value['slug']) . '" />';
    echo '<input type="hidden" name="cclw_checkout_fields[cclw_shipping_postcode][type]" value="' . esc_attr($value['type']) . '" />';

    // Label
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Label</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_postcode][label]" value="' . esc_attr($value['label']) . '" class="cclw-ad-field-input" placeholder="Postcode / ZIP">';
    echo '</div>';

    // Placeholder
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Placeholder</label>';
    echo '<input type="text" name="cclw_checkout_fields[cclw_shipping_postcode][placeholder]" value="' . esc_attr($value['placeholder']) . '" class="cclw-ad-field-input">';
    echo '</div>';

    // Required
    echo '<div class="cclw-ad-field-row">';
    echo '<label class="cclw-ad-field-label">Required</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_postcode" name="cclw_checkout_fields[cclw_shipping_postcode][required]" value="true" ' . checked($value['required'], 'true', false) . '> Yes</label>';
    echo '<label><input type="radio" class="required-toggle" data-target="cclw_shipping_postcode" name="cclw_checkout_fields[cclw_shipping_postcode][required]" value="false" ' . checked($value['required'], 'false', false) . '> No</label>';
    echo '</div>';

    // Show/Hide
    echo '<div class="cclw-ad-field-row cclw-show-hide cclw_shipping_postcode">';
    echo '<label class="cclw-ad-field-label">Show / Hide</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_postcode][show_hide]" value="show" ' . checked($value['show_hide'], 'show', false) . '> Show</label>';
    echo '<label><input type="radio" name="cclw_checkout_fields[cclw_shipping_postcode][show_hide]" value="hide" ' . checked($value['show_hide'], 'hide', false) . '> Hide</label>';
    echo '</div>';
    echo '</div>'; 
    echo '</div>';
}
