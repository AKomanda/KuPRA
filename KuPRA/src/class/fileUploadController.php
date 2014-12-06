<?php

include_once '../config.php';
include_once 'databaseController.php';

class fileUploadController {
	
	public static function uplFile($files = array(), $formats = array(), $maxSize, $path) {
		$count = 0;
		
		$real_path = rootDir . $path;
		
		foreach ( $files ['name'] as $f => $name ) {
			if ($files ['error'] [$f] == 4) {
				continue; // Skip file if any error found
			}
			if ($files ['error'] [$f] == 0) {
				if ($files ['size'] [$f] > $maxSize) {
					$message [] = "$name is too large!.";
					continue; // Skip large files
				} elseif (! in_array ( pathinfo ( $name, PATHINFO_EXTENSION ), $formats )) {
					$message [] = "$name is not a valid format";
					continue; // Skip invalid file formats
				} else { // No error found! Move uploaded files
					
					if (!file_exists($real_path)) {
						mkdir($real_path, 0777, true);
					}
					if (move_uploaded_file ( $files["tmp_name"] [$f], $real_path . $name ))
						$count ++; // Number of successfully uploaded file
				}
			}
		}
	}
	
	
	public static function uplRecepieFile ($recepieId, $files = array(), $formats = array(), $maxSize, $path) {
			$count = 0;
		
		$real_path = rootDir . $path;
		
		foreach ( $files ['name'] as $f => $name ) {
			if ($files ['error'] [$f] == 4) {
				continue; // Skip file if any error found
			}
			if ($files ['error'] [$f] == 0) {
				if ($files ['size'] [$f] > $maxSize) {
					$message [] = "$name is too large!.";
					continue; // Skip large files
				} elseif (! in_array ( pathinfo ( $name, PATHINFO_EXTENSION ), $formats )) {
					$message [] = "$name is not a valid format";
					continue; // Skip invalid file formats
				} else { // No error found! Move uploaded files
					
					if (!file_exists($real_path)) {
						mkdir($real_path, 0777, true);
					}
					if (move_uploaded_file ( $files["tmp_name"] [$f], $real_path . $name ))
						$count ++; // Number of successfully uploaded file
					
					databaseController::getDB()->insert("receptu_nuotraukos", array("receptas" => $recepieId, "Nuotrauka" => ".." . $path . $name));
				}
			}
		}
	}
	
	
}

?>