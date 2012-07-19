<?php


require_once( dirname(__FILE__).'/raven/lib/Raven/Client.php' );
require_once( dirname(__FILE__).'/raven/lib/Raven/Compat.php' );
require_once( dirname(__FILE__).'/raven/lib/Raven/ErrorHandler.php' );
require_once( dirname(__FILE__).'/raven/lib/Raven/StackTrace.php' );

class WP_Raven_Client extends Raven_Client {
	
	function __construct() {
		
		$this->settings = get_option( 'sentry-settings' );
		
		if ( !isset( $this->settings['dsn'] )) return;
		
		if ( $this->settings['dsn'] == '' ) return;
		
		parent::__construct( $this->settings['dsn'] );
		
		$this->setErrorReportingLevel( $this->settings['reporting_level'] );
		
		$this->setHandlers();
		
	}
	
	function setHandlers() {
		$error_handler = new Raven_ErrorHandler( $this );
		set_error_handler( array( $error_handler, 'handleError' ));
		set_exception_handler( array( $error_handler, 'handleException' ));
	}
	
	function setErrorReportingLevel( $level = 'E_WARNING' ) {
		
		
		
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
	
	
}


?>