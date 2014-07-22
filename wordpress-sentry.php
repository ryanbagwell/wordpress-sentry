<?php

/*
  Plugin Name: WordPress Sentry Client
  Plugin URI: http://www.hzdg.com
  Description: Sends PHP errors to Django Sentry
  Author: Ryan Bagwell
  Version: 1
  Author URI: http://www.ryanbagwell.com
 */

require_once( dirname(__FILE__) . '/class.wp-raven-client.php' );

class WPSentry extends WP_Raven_Client {

	public function __construct() {
		add_action('admin_menu', array($this, 'addOptionsPage'));

		if (is_admin() && $_POST)
			$this->saveOptions();

		parent::__construct();
	}

	public function addOptionsPage() {
		add_options_page('Sentry Error Reporting Settings', 'Sentry', 8, 'sentrysettings', array($this, 'printOptionsHTML'));
	}

	public function printOptionsHTML() {
		$error_levels = $this->errorLevelMap;
		$settings = $this->settings;
		require_once( dirname(__FILE__) . '/optionspage.html.php' );
	}

	public function saveOptions() {

		if (!isset($_POST['sentry_dsn']) || !isset($_POST['sentry_reporting_level']))
			return;

		update_option('sentry-settings', array(
			'dsn' => $_POST['sentry_dsn'],
			'reporting_level' => $_POST['sentry_reporting_level']
		));
	}
	
	public function getSettings() {
		return $this->settings;
	}

	public static function load() {
		try {
			$wps = new WPSentry();
		} catch (Exception $e) {
			
		}
	}
}

add_action('plugins_loaded', array('WPSentry', 'load'));