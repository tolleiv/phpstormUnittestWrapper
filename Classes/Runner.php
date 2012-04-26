<?php
/**
 * Base block for all runners
 */
class Runner {

	protected static $baseDir;

	protected static function appendConfigurationArguments($baseArguments) {
		$args = self::parseArguments();
		if (isset($args['groups'])) {
			$baseArguments[] = '--group';
			$baseArguments[] = $args['groups'];
		}
		if (isset($args['excludeGroups'])) {
			$baseArguments[] = '--exclude-group';
			$baseArguments[] = $args['excludeGroups'];
		}

		switch($args["mode"]) {
			case 'c':	// class
			case 'm':	// method (we will run the entire file because the CLI interface doesn't provide that option :(
				$baseArguments[] = $args["class"];
			case 'f':	// file
				$baseArguments[] = rtrim(self::$baseDir, '/') . '/' . $args["file"];
				break;
			case 'd':	// directory
				$baseArguments[] = rtrim(self::$baseDir, '/') . '/';
				break;
			case 'x':
				$baseArguments[] = '--configuration';
				$baseArguments[] = $args["config"];
				break;
			default:
		}
		return $baseArguments;
	}


	private static function parseRemoteArguments() {
		$out = array();
		global $config_file;
		// NB! Concatenation here is crucial.
		// Replace (which is faster) is used instead of replaceFirst in PhpUnitRemoteUtil
		if (strcmp($config_file, "") != 0 && strcmp($config_file, "/*config"."_xml*/") != 0) {
			$out["config"] = $config_file;
			$out["mode"] = "x";
		}

		if (isset($_GET["groups"])) {
			$out["groups"] = $_GET["groups"];
		}
		if (isset($_GET["exclude_groups"])) {
			$out["excludeGroups"] = $_GET["exclude_groups"];
		}
		if (isset($_GET["mode"])) {
			$out["mode"] = $_GET["mode"];
		}
		if (isset($_GET["file"])) {
			$out["file"] = $_GET["file"];
			if (isset($_GET["class"])) {
				$out["class"] = $_GET["class"];
				if (isset($_GET["method"])) {
					$out["method"] = $_GET["method"];
				}
			}
		}
		if ($out["mode"] == "d") {
			$out["file"] = dirname(__FILE__);
		}

		return $out;
	}

	private static function parseArguments() {
		$isLocal = !isset($_SERVER['HTTP_USER_AGENT']);
		return $isLocal ? self::parseLocalArguments() : self::parseRemoteArguments();
	}
}
