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
	
	
	//print "5 & 3 = ".(5&3)."<br>";
	//0000 0101
	//0000 0011
	//0000 0001
	//$statusByte = 7;
	
	//print("statusByte = ".(bin2hex($statusByte))."<br>");
	//print "statusByte@1 = ".(bin2hex($statusByte & 1))."<br>";
	print "statusByte = ".$statusByte."<br>";
	print "statusByte@1 = ".($statusByte & 1)."<br>";
	print "statusByte@2 = ".($statusByte & 2)."<br>";
	print "statusByte@2 = ".($statusByte & 4)."<br>";
	print "statusByte@2 = ".($statusByte & 8)."<br>";
	
		
	//print "statusByte1 = ".($statusByte & 0x01)."<br>";
	//print "statusByte2 = ".($statusByte & 0x02)."<br>";
	//print "statusByte3 = ".($statusByte & 0x04)."<br>";
	//print "statusByte4 = ".($statusByte & 0x08)."<br>";
	
	
	if($statusByte & (1 << $bit)) { 
		return 1;
	} else {
		return 0;
	}
} 
?>
