<?php
/*
Plugin Name: WordPress Sentry Client
Plugin URI: http://www.hzdg.com
Description: Sends PHP errors to Django Sentry
Author: Ryan Bagwell
Version: 1
Author URI: http://www.ryanbagwell.com
*/

require_once( dirname(__FILE__).'/raven/lib/Raven/Autoloader.php' );
Raven_Autoloader::register();

class WPSentry extends Raven_Client {
	
	function WPSentry() {
				
		if ( is_admin() && $_POST ) $this->saveOptions();
		add_action( 'admin_menu', array( $this, 'addOptionsPage' ));
		$this->settings = get_option('sentry-settings');
		$this->setErrorReportingLevel();
				
		if ( !isset($this->settings['dsn']) ) return;
		
		parent::__construct( $this->settings['dsn'] );
		
		$this->setHandlers();
		
	}
	
	function setHandlers() {
		$error_handler = new Raven_ErrorHandler( $this );
		set_error_handler( array( $error_handler, 'handleError' ));
		set_exception_handler( array( $error_handler, 'handleException' ));
	}
	
	function setErrorReportingLevel( $level = 'E_WARNING' ) {
		
		if ( isset( $this->settings['reporting_level'] ) )
			$level = $this->settings['reporting_level'];
		
		$errorLevelMap = array(
			'E_NONE' => 0,
			'E_WARNING' => 2,
			'E_NOTICE' => 8,
			'E_USER_ERROR' => 256,
			'E_USER_WARNING' => 512,
			'E_USER_NOTICE' => 1024,
			'E_RECOVERABLE_ERROR' => 4096,
			'E_ALL' => 8191
			);
		
		if ( array_key_exists( $level, $errorLevelMap ) )
			$this->_max_error_reporting_level = $errorLevelMap[ $level ];			
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