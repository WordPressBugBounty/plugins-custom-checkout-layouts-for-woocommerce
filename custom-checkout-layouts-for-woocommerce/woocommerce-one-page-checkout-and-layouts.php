<?php
/**
Plugin Name: One page checkout and layouts for Woocommerce
Plugin URI: https://wordpress.org/plugins/custom-checkout-layouts-for-woocommerce/
Description: This plugin is designed to Combine Cart and Checkout process which gives users a faster checkout experience, with less interruption.
Author: BluePlugins
Author URI: http://blueplugins.com
Version: 4.1.2
License:GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: cclw
WC requires at least: 3.4
WC tested up to: 10.0.4
*/
 
if ( ! defined( 'WPINC' ) ) {
	die;
}
 

define( 'CCLW_VERSION', '4.1.2' );
define('CCLW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define('CCLW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if( !class_exists( 'CclwCheckout' ) ) 
{
	class CclwCheckout 
	{
		
		function __construct()  
		{
		
		add_action( 'plugins_loaded',array($this,'cclw_verify_woocommerce_installed'));
		add_action('admin_init',array($this,'cclw_plugin_redirect'));
		add_action('plugins_loaded', array($this, 'cclw_load_plugin_textdomain'));	
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'cclw_action_links' ) );	
		add_action( 'admin_init',array($this,'cclw_custom_checkout_panel')) ;
        add_action('admin_menu', array($this,'cclw_custom_admin_menu')); /*Admin Menu on left dashboard*/ 		
		add_action( 'wp_enqueue_scripts',array($this,'cclw_register_plugin_styles'));
		add_filter( 'woocommerce_locate_template',array($this,'cclw_adon_plugin_template'), 20, 3 );
		add_filter ('woocommerce_checkout_cart_item_quantity',array($this,'cclw_add_quantity'), 10, 2 );	
		add_action( 'wp_footer',array($this,'cclw_add_js'));
		add_action( 'init',array($this,'cclw_load_ajax'));
		add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );
		add_action( 'before_woocommerce_init',array($this,'cclw_hpos_compatibility'), 10, 3 );
		
		/*redirect to checkout page*/
		add_action( 'template_redirect',array($this,'cclw_redirect_to_checkout_if_cart'));
		add_action( 'admin_enqueue_scripts', array( $this, 'cclw_setup_admin_scripts' ) );
	    $overide_fields = get_option( 'cclw_checkout_fields');
			  			 
		}
		function cclw_action_links( $links ) {
		$custom_links = array();
		$custom_links[] = '<a href="' . admin_url( 'admin.php?page=cclw_general_settings' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>';
		$custom_links[] = '<a style="font-weight: 800;" href="https://blueplugins.com/product/woocommerce-one-page-checkout-and-layouts-pro">' . __( 'Go Pro', 'woocommerce' ) . '</a>';
		
		  return array_merge( $custom_links, $links );
	    }
			
			
		/*load traslations*/
		 function cclw_load_plugin_textdomain() {
              $rs = load_plugin_textdomain('cclw', FALSE, basename(dirname(__FILE__)) . '/languages/');
          }
		/*Check if woocommerce is installed*/
		function cclw_verify_woocommerce_installed() {
			if ( ! class_exists( 'WooCommerce' )) {
				add_action( 'admin_notices',array($this,'cclw_show_woocommerce_error_message'));
			}
			
		}
    
		function cclw_show_woocommerce_error_message() {
			if ( current_user_can( 'activate_plugins' ) ) {
				$url = 'plugin-install.php?s=woocommerce&tab=search&type=term';
				$title = __( 'WooCommerce', 'woocommerce' );
				echo '<div class="error"><p>' . sprintf( esc_html( __( 'To begin using "%s" , please install the latest version of %s%s%s and add some product.', 'cclw' ) ), 'Custom Checkout Layouts WooCommerce', '<a href="' . esc_url( admin_url( $url ) ) . '" title="' . esc_attr( $title ) . '">', 'WooCommerce', '</a>' ) . '</p></div>';
			}
		}
		
		/* calling all the settings fields and forms on hook 'admin_init' */
		function cclw_custom_checkout_panel() {
			 
			 require_once CCLW_PLUGIN_DIR . 'includes/admin/cclw_all_setting_fields.php';/*Registers all sections and fields*/
			 require_once CCLW_PLUGIN_DIR . 'includes/admin/cclw_general_settings.php'; /*renders general settings page*/
			 require_once CCLW_PLUGIN_DIR . 'includes/admin/cclw_advance_settings.php'; /*renders advance settings page*/
			 require_once CCLW_PLUGIN_DIR . 'includes/admin/cclw_customize_checkout_fields.php'; /*renders customize checkout fields page*/
			 require_once CCLW_PLUGIN_DIR . 'includes/admin/cclw_pro_version.php'; /*renders customize checkout fields page*/
			 //require_once CCLW_PLUGIN_DIR . 'includes/admin/pro_version.php';
			
			 
		} 
		
		/**A left bar menu for plugin setting pages on hook admin_menu**/
		function cclw_custom_admin_menu() {
					add_menu_page(
						'Checkout Settings', // Page title
						'Checkout Settings', // Menu title
						'manage_options', // Capability
						'cclw_general_settings', // Menu slug
						'cclw_render_settings_page', // Callback function
						'dashicons-cart', // Icon
						20 // Position
					);

					add_submenu_page(
						'cclw_general_settings', // Parent slug
						'General Settings', // Page title
						'General Settings', // Menu title
						'manage_options', // Capability
						'cclw_general_settings', // Submenu slug
						'cclw_render_settings_page' // Callback function
					);
					 add_submenu_page(
						'cclw_general_settings',             // parent slug
						'Advanced Settings',                  // page title
						'Advanced Settings',                  // menu title
						'manage_options',
						'cclw_advance_settings',             // menu slug
						'cclw_render_advance_settings_page'  // render callback
					);
					add_submenu_page(
						'cclw_general_settings',             // parent slug
						'Customize Checkout Fields',                  // page title
						'Customize Checkout Fields',                  // menu title
						'manage_options',
						'cclw_checkout_fields',             // menu slug
						'cclw_render_customize_checkout_fields_page'  // render callback
					);
					add_submenu_page(
						'cclw_general_settings',             // parent slug
						'Pro Version',                  // page title
						'Pro Version',                  // menu title
						'manage_options',
						'cclw_pro_version',             // menu slug
						'cclw_render_pro_version_page'  // render callback
					);
				
				}
		
		/*register admin section*/
        function cclw_setup_admin_scripts($hook) {
			wp_register_style( 'cclw-admin-panel',CCLW_PLUGIN_URL.'asserts/css/admin_panel.css',array(), CCLW_VERSION);
			
			wp_enqueue_style('cclw-admin-panel');
			
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'cclw-color-picker', plugin_dir_url( __FILE__ ) . 'asserts/js/cclw_color-picker-init.js', array( 'wp-color-picker' ), CCLW_VERSION, true );
            wp_enqueue_script('cclw_admin_js',CCLW_PLUGIN_URL.'asserts/js/cclw_admin_scripts.js', array('jquery'),CCLW_VERSION, true);
		    wp_localize_script('cclw_admin_js', 'cclw_ajax',array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
			
						 
        }
	
		/**
		* Register style sheet.
		*/
		function cclw_register_plugin_styles() {
				
			if(is_checkout())
			{
				wp_register_style( 'custom-checkout-css', CCLW_PLUGIN_URL .'asserts/css/custom-checkout.css', array(), CCLW_VERSION );
				wp_enqueue_style( 'custom-checkout-css' );
				
			    /*add custom Jquery*/
				wp_enqueue_script('custom-checkout-js',CCLW_PLUGIN_URL.'asserts/js/custom-checkout.js', array('jquery'),CCLW_VERSION, true);
				wp_localize_script('custom-checkout-js', 'cclw_front_ajax',array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
				
				/*Jquery library*/
				wp_register_style( 'cclw-front-tabs', CCLW_PLUGIN_URL .'asserts/css/cclw-front-tabs.css', array(), CCLW_VERSION );
				wp_enqueue_style( 'cclw-front-tabs' );
				wp_enqueue_script("jquery");
                wp_enqueue_script("jquery-ui-dialog");
				wp_enqueue_script('cclw-front-tabs_js',CCLW_PLUGIN_URL.'asserts/js/cclw-front-tabs.js', array('jquery'),CCLW_VERSION, true);
				
			}	
		
 
		}
	
		/*Locate new woocommerce setting folder */
		function cclw_adon_plugin_template( $template, $template_name, $template_path ) {
			 global $woocommerce;
			 $_template = $template;
			 if ( ! $template_path ) 
			  $template_path = $woocommerce->template_url;
			 $plugin_path  = untrailingslashit( plugin_dir_path( __FILE__ ) )  . '/WooCommerce/';
            if(is_checkout())
			{
			   $template = $plugin_path . $template_name;
			
				if ( file_exists( $template ) ) {
				$template = $plugin_path . $template_name;
				}
				else
				{
				$template = $_template;
				}
			 
			}
            else
			{
				$template = $_template;
			}
			return $template;
			}
			
	    	
          /*set product quantity*/ 
		
	   
		    function cclw_add_quantity( $cart_item, $cart_item_key ) {
				   $product_quantity= '';
				   return intval($product_quantity);
			}
				
		/**add some footer js*/		
		
     	
            function cclw_add_js(){
			
			require_once CCLW_PLUGIN_DIR . '/includes/template_style.php';
			     	    
            }
		
			
        /*starts ajax*/
        function cclw_load_ajax() {
			$hide_notes = get_option( 'cclw_general_settings');

			if(isset($hide_notes) && !empty($hide_notes))
			{
				$hide_notes  = $hide_notes['order_notes'];
				if($hide_notes == 'yes')
				{
				add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );  
				}
			}
					
			
            if ( !is_user_logged_in() ){
                add_action( 'wp_ajax_nopriv_cclw_update_order_review',array($this,'cclw_update_order_review'));
			} else{
                add_action( 'wp_ajax_cclw_update_order_review',array($this,'cclw_update_order_review'));
			}
			
			require_once CCLW_PLUGIN_DIR . '/includes/compatibility_functions.php';
			
		       
        }
        
		
        function cclw_update_order_review() {
             
            $values = array();
		    parse_str($_POST['post_data'], $values);
		    $cart = $values['cart'];
            foreach ( $cart as $cart_key => $cart_value ){
                WC()->cart->set_quantity( $cart_key, $cart_value['qty'], true );
                WC()->cart->calculate_totals();
                woocommerce_cart_totals();
            }
            exit;
        }
		
				
		function cclw_redirect_to_checkout_if_cart() {
			global $woocommerce;
			$checkout_setting = get_option( 'cclw_general_settings' ); 
			
			
			if ( is_cart() && WC()->cart->get_cart_contents_count() > 0 && isset($checkout_setting['skip_cart']) && $checkout_setting['skip_cart'] =='yes')
			{
			
			// Redirect to check out url
			wp_redirect( $woocommerce->cart->get_checkout_url(), '301' );
			exit;
			}
			
		}

	public function cclw_hpos_compatibility() {
	if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
	// Declare HPOS support
	\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );

		}
	} 
	/*register activation hook*/
	public static function cclw_myplugin_activate() {
		add_option('cclw_do_activation_redirect', true);
		update_option( 'woocommerce_cart_block_enabled', 'no' );
		update_option( 'woocommerce_checkout_block_enabled', 'no' );

		$pages = [
		'cart' => '[woocommerce_cart]',
		'checkout' => '[woocommerce_checkout]',
		];

		foreach ( $pages as $slug => $shortcode ) {
			$page = get_page_by_path( $slug );
			if ( $page && has_block( 'woocommerce/' . $slug, $page ) ) {
				//$shortcode_block = "<!-- wp:shortcode -->\n$shortcode\n<!-- /wp:shortcode -->";

				wp_update_post( [
					'ID' => $page->ID,
					'post_content' => $shortcode,
				] );
			}
		}

	}

	/*redirect after activation*/
	function cclw_plugin_redirect() {
		if (get_option('cclw_do_activation_redirect', false)) {
			delete_option('cclw_do_activation_redirect');
			wp_redirect(admin_url( 'admin.php?page=cclw_general_settings' ) );
		}
    }
		
		
	 public static function cclw_myplugin_deactivate() {
	/* 	nothing to do  */
		}
     
		
	
	}// end of class
}// end of if class
register_activation_hook(__FILE__, array('CclwCheckout', 'cclw_myplugin_activate'));
register_deactivation_hook(__FILE__, array('CclwCheckout', 'cclw_myplugin_deactivate'));

$overide_fields = get_option( 'cclw_checkout_fields');
if(isset($overide_fields['cclw_overide_fields']) && $overide_fields['cclw_overide_fields'] == 'yes' )
	{
// Modify WooCommerce default address fields with dynamic admin settings
add_filter('woocommerce_billing_fields', 'cclw_override_billing_fields');
function cclw_override_billing_fields($fields) {
    $options = get_option('cclw_checkout_fields', []);
	if (!isset($fields['billing_company'])) {
    $fields['billing_company'] = [
        'label' => 'Company',
        'required' => false,
        'class' => ['form-row-wide'],
        'clear' => true,
        'type' => 'text',
        'priority' => 30,
    ];
}

    foreach ($fields as $key => &$field) {
        $slug = str_replace('billing_', '', $key);
        $custom = $options['cclw_billing_' . $slug] ?? null;

        if ($custom && is_array($custom)) {
            if (!empty($custom['label'])) {
                $field['label'] = $custom['label'];
            }
            if (!empty($custom['placeholder'])) {
                $field['placeholder'] = $custom['placeholder'];
                $field['custom_attributes']['data-placeholder'] = $custom['placeholder'];
            }
            if (isset($custom['required'])) {
                $field['required'] = ($custom['required'] === 'true');
            }
            if (isset($custom['show_hide']) && $custom['show_hide'] === 'hide') {
                unset($fields[$key]);
            }
			if (!empty($custom['width'])) {
                // Remove any existing Woo width classes
                $field['class'] = array_diff($field['class'], ['form-row-first', 'form-row-last', 'form-row-wide']);
                $field['class'][] = $custom['width'];
            }
        }
    }

    return $fields;
}
add_filter('woocommerce_shipping_fields', 'cclw_override_shipping_fields');
function cclw_override_shipping_fields($fields) {
    $options = get_option('cclw_checkout_fields', []);

    foreach ($fields as $key => &$field) {
        $slug = str_replace('shipping_', '', $key);
        $custom = $options['cclw_shipping_' . $slug] ?? null;

        if ($custom && is_array($custom)) {
            if (!empty($custom['label'])) {
                $field['label'] = $custom['label'];
            }
            if (!empty($custom['placeholder'])) {
                $field['placeholder'] = $custom['placeholder'];
                $field['custom_attributes']['data-placeholder'] = $custom['placeholder'];
            }
            if (isset($custom['required'])) {
                $field['required'] = ($custom['required'] === 'true');
            }
            if (isset($custom['show_hide']) && $custom['show_hide'] === 'hide') {
                unset($fields[$key]);
            }
			if (!empty($custom['width'])) {
                // Remove any existing Woo width classes
                $field['class'] = array_diff($field['class'], ['form-row-first', 'form-row-last', 'form-row-wide']);
                $field['class'][] = $custom['width'];
            }
        }
    }

    return $fields;
}

// Enqueue JS and pass dynamic labels & placeholders to frontend

add_action('wp_enqueue_scripts', 'cclw_enqueue_dynamic_fields_script');
function cclw_enqueue_dynamic_fields_script() {
    $checkout_fields = get_option('cclw_checkout_fields', []);

    $dynamic_fields = [
        'billing'  => [],
        'shipping' => [],
    ];

    foreach ($checkout_fields as $field) {
        $slug = $field['slug'] ?? '';
        $type = $field['type'] ?? 'billing'; // fallback to billing

        if ($slug) {
            $dynamic_fields[$type][$slug] = [
                'placeholder' => $field['placeholder'] ?? '',
                'label'       => $field['label'] ?? '',
            ];
        }
    }

    wp_enqueue_script(
        'cclw-fix-placeholders-labels',
        plugin_dir_url(__FILE__) . 'asserts/js/dynamic_placeholder.js',
        ['jquery'],
        '1.0',
        true
    );

    wp_localize_script('cclw-fix-placeholders-labels', 'cclw_dynamic_fields', $dynamic_fields);
}

	}


$CclwCheckout_obj = new CclwCheckout();   