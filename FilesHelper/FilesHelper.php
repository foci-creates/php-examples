<?php

class FilesHelper {

	public static function hasData($filename) : bool {

		if(!file_exists($filename)) {
			echo "$filename does NOT exist!" . "<br>";
			return false;
		} else {
			$content = file_get_contents($filename);

			if(empty($content)) {
				return false;
			} else {
				return true;
			}
		}
	}
}

if(FilesHelper::hasData("Test.txt")) {
	echo "File is available!" . "<br>";
} else {
	echo "File is NOT available!" . "<br>";
}