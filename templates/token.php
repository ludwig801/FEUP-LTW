<?php

	function newToken($size) {
		
		$dicionary = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 
								'r', 's', 't', 'u', 'v', 'w', 'y', 'x', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
		$result = "";
		$max = sizeof($dicionary) - 1;
		
		for($x = 0; $x < $size; $x++) {
			$r = rand(0, $max);
			$c = $dicionary[$r];
			$result = $result . $c;
		}
		
		return $result;
	}

?>