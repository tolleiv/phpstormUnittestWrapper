<?php

require('Runner.php');

/**
 * Encapsulate the phpunit call for TYPO3
 */
class TYPO3TestRunner extends Runner {
	/**
	 * Pretty much a cli_dispatch.phpsh copied and stripped down a bit
	 *
	 * @param $workingDirectory
	 * @param $configFile
	 */
	public function main($workingDirectory) {
			// make sure the TYPO3 variables are put into $GLOBALS
		global $LOCAL_LANG, $TYPO3_CONF_VARS, $TCA, $PAGES_TYPES, $ICON_TYPES, $TBE_MODULES, $TBE_STYLES, $FILEICONS,
			   $BE_USER, $TBE_MODULES_EXT, $TCA_DESCR, $TYPO3_AJAX, $TYPO3_DB, $MCONF, $EXEC_TIME;

		// mimic CLI API in CGI API (you must use the -C/-no-chdir and the -q/--no-header switches!)
		ini_set('html_errors', 0);
		ini_set('implicit_flush', 1);
		ini_set('max_execution_time', 0);

		define('STDIN', fopen('php://stdin', 'r'));
		define('STDOUT', fopen('php://stdout', 'w'));
		define('STDERR', fopen('php://stderr', 'w'));

			// Defining circumstances for CLI mode:
		define('TYPO3_cliMode', TRUE);
		define('PATH_thisScript',rtrim($workingDirectory,'/') . '/typo3/cli_dispatch.phpsh');
		define('TYPO3_cliKey', 'phpunit');

		$arguments = array(
			PATH_thisScript,
			'phpunit',
			'--printer',
			'IdeTestListener'
		);

		$scriptDirectory = dirname($_SERVER['REDIRECT_SCRIPT_URL']);
		self::$baseDir = $workingDirectory . $scriptDirectory;
		$_SERVER['argv'] = self::appendConfigurationArguments($arguments);
		$_SERVER['argc'] = count($_SERVER['argv']);
/*
		var_dump($_SERVER);
		var_dump($_REQUEST);
		var_dump(self::$baseDir);
		var_dump($_SERVER['argv']);
*/
		require(dirname(PATH_thisScript).'/init.php');  ob_end_clean();
		t3lib_div::flushOutputBuffers();
		include(TYPO3_cliInclude);
	}
}