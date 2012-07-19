<?php
/*
Plugin Name: WordPress Sentry Client
Plugin URI: http://www.hzdg.com
Description: Sends PHP errors to Django Sentry
Author: Ryan Bagwell
Version: 1
Author URI: http://www.ryanbagwell.com
*/

require_once( dirname(__FILE__).'/class.wp-raven-client.php' );

class WPSentry extends WP_Raven_Client {
	
	function WPSentry() {

		add_action( 'admin_menu', array( $this, 'addOptionsPage' ));
				
		if ( is_admin() && $_POST )
			$this->saveOptions();
		
		parent::__construct();
		
	}
	
	function addOptionsPage() {
		add_options_page('Sentry Error Reporting Settings', 'Sentry', 8, 'sentrysettings', array( $this, 'printOptionsHTML' ));
	}
	
	function printOptionsHTML() {		
		extract( $this->settings );
		require_once( dirname(__FILE__).'/optionspage.html.php' );	
	}
	
	function saveOptions() {
		
		if ( !isset( $_POST[ 'sentry_dsn' ] ) || !isset( $_POST[ 'sentry_reporting_level' ]))
			return;
		
		update_option('sentry-settings', array(
			'dsn' => $_POST[ 'sentry_dsn' ],
			'reporting_level' => $_POST[ 'sentry_reporting_level' ]
		));

	}

}

add_action('plugins_loaded', create_function(null, '$wps = new WPSentry(); ') );