<?php
		
 // Register the setting for general settings(group and option name)
    register_setting(
        'cclw_general_settings_group',   // Group name 
        'cclw_general_settings'          // Option key saved in wp_options
    );

    // Add settings section (must match the page slug used in menu)
    add_settings_section(
        'cclw_general_settings_section', // Section ID
        'General Settings',              // Section Title
        '__return_false',                // No description callback
        'cclw_general_settings'          // Page slug
    );

    // Add fields to settings section

    add_settings_field(
        'checkout_layouts',              // Field ID
        'Checkout Page Layouts',         // Label
        'cclw_select_checkout_layouts_cb', // Callback to render the field
        'cclw_general_settings',         // Page slug
        'cclw_general_settings_section'  // Section ID
    );
		add_settings_field(
		'checkout_ordertable',                   // Field ID
		'Order Table Design Options',            // Label
		'cclw_select_order_table_cb',            // Callback
		'cclw_general_settings',
		'cclw_general_settings_section'
	);

	add_settings_field(
		'skip_cart',                             // Field ID
		'Skip Cart Page',                        // Label
		'cclw_radio_skip_cart_cb',               // Callback
		'cclw_general_settings',
		'cclw_general_settings_section'
	);

	add_settings_field(
		'skip_qty',                              // Field ID
		'Non Changeable Qty',                    // Label
		'cclw_radio_skip_qty_cb',                // Callback
		'cclw_general_settings',
		'cclw_general_settings_section'
	);

	add_settings_field(
		'order_notes',                           // Field ID
		'Hide Order Notes',                      // Label
		'cclw_radio_order_notes_cb',             // Callback
		'cclw_general_settings',
		'cclw_general_settings_section'
	);	
	
	 // Register the setting for advance settings(group and option name)
    register_setting(
        'cclw_advance_settings_group',   // Group name 
        'cclw_advance_settings'          // Option key saved in wp_options
    );
	/*Header section*/
	add_settings_section(
        'cclw_header_section',
        '',//hide default title
        null,
        'cclw_advance_settings'
    );
	add_settings_field(
			'header_design',//field id and array value
			'',//No title here
			'cclw_header_design_callback',
			'cclw_advance_settings',//page slug
			'cclw_header_section'//nested inside "the value will be saved in array nested inside this"
		);
	
	
	add_settings_section(
        'cclw_button_section',
        '',//hide title
        '__return_false',
        'cclw_advance_settings'
    );
	
	add_settings_field(
			'buttons_design',//field id and array value
			'Button Style',
			'cclw_buttons_design_callback',
			'cclw_advance_settings',//page slug
			'cclw_button_section'//nested inside "the value will be saved in array nested inside this"
	);

    
	
	
	// Register the setting for customize checkout fields(group and option name)
    register_setting(
        'cclw_customize_checkout_fields_group',   // Group name 
        'cclw_checkout_fields',       // Option key saved in wp_options
    );

     add_settings_section(
        'cclw_overide_fields',              // Section ID
        '',                                  // Section Title
        '__return_false',                   // No description callback
        'cclw_checkout_fields'             // Page slug
    );
     
    add_settings_field('cclw_overide_fields', 'Override Billing/Shipping Fields', 'cclw_overide_fields_cb', 'cclw_checkout_fields', 'cclw_overide_fields');

      add_settings_section(
        'cclw_billing_section',              // Section ID
        '',                                // Section Title
        '__return_false',                   // No description callback
        'cclw_checkout_fields'            // Page slug
    );

    
     add_settings_field('cclw_billing_first_name', 'Billing First name', 'cclw_billing_first_name_cb', 'cclw_checkout_fields', 'cclw_billing_section');
     add_settings_field('cclw_billing_last_name', 'Billing Last Name', 'cclw_billing_last_name_cb', 'cclw_checkout_fields', 'cclw_billing_section');
	 add_settings_field('cclw_billing_company', 'Billing Company Name', 'cclw_billing_company_cb', 'cclw_checkout_fields', 'cclw_billing_section');
	 add_settings_field('cclw_billing_country', 'Billing Country', 'cclw_billing_country_cb', 'cclw_checkout_fields', 'cclw_billing_section');
	 add_settings_field('cclw_billing_address_1', 'Billing Street address', 'cclw_billing_address_1_cb', 'cclw_checkout_fields', 'cclw_billing_section');
	 add_settings_field('cclw_billing_address_2', 'Billing Address/unit etc', 'cclw_billing_address_2_cb', 'cclw_checkout_fields', 'cclw_billing_section');
	 add_settings_field('cclw_billing_city', 'Billing City', 'cclw_billing_city_cb', 'cclw_checkout_fields', 'cclw_billing_section');
	 add_settings_field('cclw_billing_state', 'Billing State', 'cclw_billing_state_cb', 'cclw_checkout_fields', 'cclw_billing_section');
	 add_settings_field('cclw_billing_postcode', 'Billing PostCode', 'cclw_billing_postcode_cb', 'cclw_checkout_fields', 'cclw_billing_section');
	 add_settings_field('cclw_billing_phone', 'Billing Phone', 'cclw_billing_phone_cb', 'cclw_checkout_fields', 'cclw_billing_section');
	 add_settings_field('cclw_billing_email', 'Billing Email', 'cclw_billing_email_cb', 'cclw_checkout_fields', 'cclw_billing_section');


	add_settings_section(
	'cclw_shipping_section',              // Section ID
	'',                                // Section Title
	'__return_false',                   // No description callback
	'cclw_checkout_fields'            // Page slug
	);


	add_settings_field('cclw_shipping_first_name', 'Shipping First name', 'cclw_shipping_first_name_cb', 'cclw_checkout_fields', 'cclw_shipping_section');
	add_settings_field('cclw_shipping_last_name', 'Shipping Last Name', 'cclw_shipping_last_name_cb', 'cclw_checkout_fields', 'cclw_shipping_section');
	add_settings_field('cclw_shipping_country', 'Shipping Country', 'cclw_shipping_country_cb', 'cclw_checkout_fields', 'cclw_shipping_section');
	add_settings_field('cclw_shipping_address_1', 'Shipping Street address', 'cclw_shipping_address_1_cb', 'cclw_checkout_fields', 'cclw_shipping_section');
	add_settings_field('cclw_shipping_address_2', 'Shipping Address/unit etc', 'cclw_shipping_address_2_cb', 'cclw_checkout_fields', 'cclw_shipping_section');
	add_settings_field('cclw_shipping_city', 'Shipping City', 'cclw_shipping_city_cb', 'cclw_checkout_fields', 'cclw_shipping_section');
	add_settings_field('cclw_shipping_state', 'Shipping State', 'cclw_shipping_state_cb', 'cclw_checkout_fields', 'cclw_shipping_section');
	add_settings_field('cclw_shipping_postcode', 'Shipping PostCode', 'cclw_shipping_postcode_cb', 'cclw_checkout_fields', 'cclw_shipping_section');
	
// Register the setting for pro version
    register_setting(
        'cclw_pro_version_group',   // Group name 
        'cclw_pro_version'          // Option key saved in wp_options
    );

    // Add settings section (must match the page slug used in menu)
    add_settings_section(
        'cclw_pro_version_section', // Section ID
        '',                        // Section Title
        '__return_false',                // No description callback
        'cclw_pro_version'          // Page slug
    );

	add_settings_field('cclw_pro_banner', '', 'cclw_pro_banner_cb', 'cclw_pro_version', 'cclw_pro_version_section');