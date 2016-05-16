<?php

require_once dirname(__FILE__) . '/raven/lib/Raven/Autoloader.php';
Raven_Autoloader::register();

class WP_Raven_Client extends Raven_Client {

	protected $settings;

	/**
	 * @var array
	 */
	protected $errorLevelMap;

	public function __construct() {

		$this->errorLevelMap = array(
			'E_NONE' => 0,
			'E_ERROR' => 1,
			'E_WARNING' => 2,
			'E_PARSE' => 4,
			'E_NOTICE' => 8,
			'E_USER_ERROR' => 256,
			'E_USER_WARNING' => 512,
			'E_USER_NOTICE' => 1024,
			'E_RECOVERABLE_ERROR' => 4096,
			'E_ALL' => 8191);

		$this->settings = get_option('sentry-settings');

		if (!isset($this->settings['dsn']))
			return;

		if ($this->settings['dsn'] == '')
			return;

		parent::__construct($this->settings['dsn']);

		$this->setErrorReportingLevel(
				$this->settings['reporting_level']);

		$this->setHandlers();
	}

	private function setHandlers() {
		$error_handler = new Raven_ErrorHandler($this);
		$error_handler->registerErrorHandler();
		$error_handler->registerExceptionHandler();
		$error_handler->registerShutdownFunction();
	}

	private function setErrorReportingLevel($level = 'E_ERROR')
	{
		error_reporting($this->errorLevelMap[$level]);
	}

}
