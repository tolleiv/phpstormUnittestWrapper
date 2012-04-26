<?php
/**
 * Used to catch all Loader calls from the original script.
 */
class IdePhpunitNullLoader {
	public static $PHPUnitVersionId = '00';
	public static function __callStatic($name, $argv) {
		// null;
	}
	public function __call($name, $argv) {
		// null;
	}
}