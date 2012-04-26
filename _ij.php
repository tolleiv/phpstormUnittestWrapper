<?php

error_reporting(E_ALL);

/**
 * modify the launcher file to avoid that it actually runs things
 * but include (eval) it to make sure all settings and functions are defined
 */
require_once('Classes/IdePhpunitNullLoader.php');
$origLauncher = file_get_contents('..' . $_SERVER['REDIRECT_SCRIPT_URL']);
$replacements = array(
	'<?php' => ' ',
	'IDE_PHPUnit_Loader::' => 'IdePhpunitNullLoader::',
	'$isPhpUnit3_5 = fileExistsInIncludePath(\'PHPUnit/Autoload.php\');' => '',
	'MyTestRunner::main();' => '',
);
$launcherLib = str_replace(array_keys($replacements), array_values($replacements), $origLauncher);
$topPart = substr($launcherLib, 0, strpos($launcherLib, 'class SimpleTestListener')-1);
$subPart = substr($launcherLib, strpos($launcherLib, 'class SimpleTestListener')-1);
eval($topPart);

/**
 * Include EXT:phpunit and trigger the testrunner
 */
$directory = realpath(dirname($_SERVER['SCRIPT_FILENAME']) . '/..');
require_once($directory . '/typo3conf/ext/phpunit/PEAR/PHPUnit/Util/Printer.php');
require_once($directory . '/typo3conf/ext/phpunit/PEAR/PHPUnit/Framework/TestListener.php');
eval($subPart);
require_once('Classes/IdeTestListener.php');
require_once('Classes/TYPO3TestRunner.php');
TYPO3TestRunner::main($directory);

