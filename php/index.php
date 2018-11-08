<html>
 <head>
  <title>Test diody</title>
 </head>
 <body>
	<?php
	
	ini_set('error_reporting',E_ALL);
	ini_set('display_errors',1);
	define('PHP_PATH', '/var/www/html/php/');
	define('GPIO_STATE_FILE_PATH', '/var/www/html/gpiostate');
	define('GPIO_STATE_FILE_SIZE', 1);
	define('GPIO_APP_FILE_PATH', '/var/www/html/power-switch-x4');
	define('GPIO_ON_COMMAND', 'turnon');
	define('GPIO_OFF_COMMAND', 'turnoff');
	define ('PIN1_BIT',1);
	define ('PIN2_BIT',2);
	define ('PIN3_BIT',3);
	define ('PIN4_BIT',4);
	define ('CHANNEL1_LABEL','PC');
	define ('CHANNEL2_LABEL','TV');
	define ('CHANNEL3_LABEL','');
	define ('CHANNEL4_LABEL','LAMPA');
	define ('ALL_ON_LABEL','Włącz<br>wszystkie');
	define ('ALL_OFF_LABEL','Wyłącz<br>wszystkie');
	define ('RESTART_LABEL','Zrestartuj<br>listwę');
	define ('REFRESH_LABEL','Odświerz<br>interfejs');
	define ('CELL_HEIGHT',100);	
		
		
	require(PHP_PATH.'functions.php'); 
	$isrestart = 0;
	$isaction = 0;
		
	do {
		print "<center>";
		print "<table border = 1 cellspacing = 10 cellpadding = 10 width = 600>";
		print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." colspan=2>";
						
		if(isset($_GET['action'])){
			$isaction = 1;
			if ($_GET['action']=="turnon1") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."1");
			} else if ($_GET['action']=="turnoff1") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."1");
			} else if ($_GET['action']=="turnon2") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."2");
			} else if ($_GET['action']=="turnoff2") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."2");
			} else if ($_GET['action']=="turnon3") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."3");
			} else if ($_GET['action']=="turnoff3") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."3");
			} else if ($_GET['action']=="turnon4") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."4");
			} else if ($_GET['action']=="turnoff4") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."4");
			} else if ($_GET['action']=="turnonall") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."all");
			} else if ($_GET['action']=="turnoffall") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."all");
			} else if ($_GET['action']=="restart") {
				$shutdown = shell_exec('shutdown -r now');
				print $shutdown;
				$isrestart = 1;
			}
		} 
	
		
	if ($isrestart) {
		print ("Odczekaj minutę a następnie odświerz <br>interfejs klikając w poniższy link<br>");
		print ("<a href = index.php>".REFRESH_LABEL."</a><br>");
		break;
	}
	
	if (!$isaction){
		print ("Listwa gotowa !");
	} 
	
	$stateByte = getGPIOstate();
	print "<br>stateByte = 0x".bin2hex($stateByte)."<br>";
	$stateByteDec = hexdec(bin2hex($stateByte));

	print "</td></tr>";

/*
	//PIN1 info
	if (checkIfBitSet($stateByteDec,PIN1_BIT))
		print "1 is ON<br>";
	else 
		print "1 is OFF<br>";
	//PIN2 info
	if (checkIfBitSet($stateByteDec,PIN2_BIT))
		print "2 is ON<br>";
	else 
		print "2 is OFF<br>";
	//PIN3 info
	if (checkIfBitSet($stateByteDec,PIN3_BIT))
		print "3 is ON<br>";
	else 
		print "3 is OFF<br>";
	//PIN4 info
	if (checkIfBitSet($stateByteDec,PIN4_BIT))
		print "4 is ON<br>";
	else 
		print "4 is OFF<br>";
*/	

			
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=turnon1>".CHANNEL1_LABEL."</a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=turnon2>".CHANNEL2_LABEL."</a></td></tr>";
	
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=turnon3>".CHANNEL3_LABEL."</a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=turnon4>".CHANNEL4_LABEL."</a></td></tr>";
	
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=turnonall>".ALL_ON_LABEL."</a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=turnoffall>".ALL_OFF_LABEL."</a></td></tr>";
	
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=restart>".RESTART_LABEL."</a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php>".REFRESH_LABEL."</a></td></tr>";
	
	
	} while (0);
	
	print "</td></tr></table>";
	print "</center>";
	
	?>
   </body>
</html>
