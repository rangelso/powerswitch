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
	define ('FONT_SIZE','5');	
	define ('FONT_FACE','Helvetica');
	define ('BG_ON_COL','#c3c3c3');
	define ('BG_OFF_COL','white');
		
		
	require(PHP_PATH.'functions.php'); 
	$isrestart = 0;
	$isaction = 0;
		
	do {
		print "<center>";
		print "<table border = 1 cellspacing = 10 cellpadding = 10 width = 600 bordercolor=#e8e8e8>";
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

	$bg1col = BG_OFF_COL;
	$bg2col = BG_OFF_COL;
	$bg3col = BG_OFF_COL;
	$bg4col = BG_OFF_COL;
	
	$action1 = GPIO_ON_COMMAND."1";
	$action2 = GPIO_ON_COMMAND."2";
	$action3 = GPIO_ON_COMMAND."3";
	$action4 = GPIO_ON_COMMAND."4";
	
	if (checkIfBitSet($stateByteDec,PIN1_BIT)){
		$bg1col = BG_ON_COL;
		$action1 = GPIO_OFF_COMMAND."1";
	}

	if (checkIfBitSet($stateByteDec,PIN2_BIT)){
		$bg2col = BG_ON_COL;
		$action2 = GPIO_OFF_COMMAND."2";	
	}

	if (checkIfBitSet($stateByteDec,PIN3_BIT)){
		$bg3col = BG_ON_COL;
		$action3 = GPIO_OFF_COMMAND."3";
	}

	if (checkIfBitSet($stateByteDec,PIN4_BIT)){
		$bg4col = BG_ON_COL;
		$action4 = GPIO_OFF_COMMAND."4";
	}

			
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".$bg1col.">";
	print "<a href = index.php?action=".$action1."><font size = ".FONT_SIZE." face = ".FONT_FACE.">".CHANNEL1_LABEL."</font></a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".$bg2col.">";
	print "<a href = index.php?action=".$action2."><font size = ".FONT_SIZE." face = ".FONT_FACE.">".CHANNEL2_LABEL."</font></a></td></tr>";
	
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".$bg3col.">";
	print "<a href = index.php?action=".$action3."><font size = ".FONT_SIZE." face = ".FONT_FACE.">".CHANNEL3_LABEL."</font></a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".$bg4col.">";
	print "<a href = index.php?action=".$action4."><font size = ".FONT_SIZE." face = ".FONT_FACE.">".CHANNEL4_LABEL."</font></a></td></tr>";
	
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=turnonall><font size = ".FONT_SIZE." face = ".FONT_FACE.">".ALL_ON_LABEL."</font></a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=turnoffall><font size = ".FONT_SIZE." face = ".FONT_FACE.">".ALL_OFF_LABEL."</font></a></td></tr>";
	
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=restart><font size = ".FONT_SIZE." face = ".FONT_FACE.">".RESTART_LABEL."</font></a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php><font size = ".FONT_SIZE." face = ".FONT_FACE.">".REFRESH_LABEL."</font></a></td></tr>";
	
	
	} while (0);
	
	print "</td></tr></table>";
	print "</center>";
	
	?>
   </body>
</html>
