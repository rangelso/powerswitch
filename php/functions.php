<?php

function getGPIOstate() {
if (!file_exists(GPIO_STATE_FILE_PATH)){
	print "file_exists returned -1";
	return -1;
	}
$file = fopen(GPIO_STATE_FILE_PATH, "r");
if ($file == false) {
	print "fopen returned -1";
	return -1;
	}
if(feof($file)) {
	print "feof returned -1";
	return -1;
	}
$stateByte = fread($file,GPIO_STATE_FILE_SIZE);
fclose($file);
return $stateByte;
}

function checkIfBitSet($statusByte, $bit){
	$bit--;
	
	if($statusByte & (1 << $bit)) { 
		return 1;
	} else {
		return 0;
	}
} 
?>
