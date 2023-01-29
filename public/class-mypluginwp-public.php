<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mypluginwp
 * @since      1.0.0
 *
 * @package    Mypluginwp
 * @subpackage Mypluginwp/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mypluginwp
 * @subpackage Mypluginwp/public
 * @author     mypluginwp <mypluginwp@mypluginwp.mypluginwp>
 */
class Mypluginwp_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mypluginwp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mypluginwp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mypluginwp-public.css', array(), $this->version, 'all' );
		// Print all loaded Scripts
		global $wp_scripts;
			foreach( $wp_scripts->queue as $script ) :
			
				$exclude = array("admin-bar","woocommerce",
				"selectWoo", "wc-add-to-cart","wc-cart-fragments") ;
				if (in_array($script, $exclude))
					continue;
					// deb($script);
			wp_dequeue_script( $script );
			endforeach;
	
			// Print all loaded Styles (CSS)
			global $wp_styles;
			foreach( $wp_styles->queue as $style ) :
				$exclude = array("admin-bar","wp-block-library","global-styles","wp-webfonts","select2",
				"woocommerce-layout","woocommerce-smallscreen","woocommerce-general","woocommerce-inline") ;
				if (in_array($style, $exclude))
					continue;
				// deb($style);
				wp_dequeue_style( $style );
			endforeach;
		
		// exit();

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

	}


	public function mypwp_template_redirect(){
			global $wp;
		
		
			// if(wp_get_current_user() && wp_get_current_user()->ID != 1){ //kalau login ke svelte dashboard
			if(wp_get_current_user()->ID !== 0){ //kalau login ke svelte dashboard
				include_once dirname( __FILE__ ) . '/partials/dashboard.php';
				exit();
			}else{

				if(is_front_page()){
					include_once dirname( __FILE__ ) . '/partials/front_page.php';
					exit();
				}else{
					
					include_once dirname( __FILE__ ) . '/partials/default.php';
					exit();
				}

			}
			
		
			
	}

	public function mypwp_woocommerce_register_form(){
		include_once dirname( __FILE__ ) . '/partials/mypwp_woocommerce_register_form.php' ;

	}

	
	public function mypwp_woocommerce_created_customer($customer_id, $new_customer_data, $password_generated){
		
		if($_POST['type_reg'] === 'pentadbir'){
			$updated = update_user_meta( $customer_id, 'wp_capabilities', array('pentadbir' => 1) );
			$updated = update_user_meta( $customer_id, 'role', 1 );
			$updated = update_user_meta( $customer_id, 'stageDaftar', 0 );
			
		}

		if($_POST['type_reg'] === 'ahli'){
			$updated = update_user_meta( $customer_id, 'wp_capabilities', array('ahli' => 1) );
			$updated = update_user_meta( $customer_id, 'stageDaftar', 0 );
			$updated = update_user_meta( $customer_id, 'role', 2 );
			$updated = update_user_meta( $customer_id, 'groupId', $_POST['groupId'] );
		}

	}


	function mypwp_check_admin_referer($action, $result)
	{
		/**
		 * Allow logout without confirmation
		 */
		if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
			$redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : home_url();
			$location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
			header("Location: $location");
			die;
		}
	}

}
