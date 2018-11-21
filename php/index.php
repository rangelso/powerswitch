<html>
 <head>
  <title>PANEL STEROWANIA POWERBOX@PI.4 DLA CHATA ANI</title>
 </head>
 <body bgcolor = #bdd4f9>
	<?php
	
	ini_set('error_reporting',E_ALL);
	ini_set('display_errors',1);
			
	define('HTML_PATH', '/var/www/html/');
	define('PHP_PATH', HTML_PATH.'php/');
	require(PHP_PATH.'config.php'); 	
	require(PHP_PATH.'functions.php'); 
	$isrestart = 0;
	$isaction = 0;
		
	do {
		print "<center>";
		print "<table border = 1 cellspacing = 10 cellpadding = 10 width = 800 bordercolor=#c3c3c3 bgcolor=white>";
		print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." colspan=2>";
		print "<font size = 2 face = ".FONT_FACE.">";
						
		if(isset($_GET['action'])){
			$isaction = 1;
			if ($_GET['action']=="turnon1") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."1");
				print "path = ".GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."1<br>";
			} else if ($_GET['action']=="turnoff1") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."1");
				print "path = ".GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."1<br>";
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
			} else if ($_GET['action']=="shutdown") {
				$shutdown = shell_exec('sudo shutdown -h -P now');
				$isrestart = 1;
			} else if ($_GET['action']=="reboot") {
				$shutdown = shell_exec('sudo reboot');
				$isrestart = 1;
			}
		} 
	
		
	/*	
	if ($isrestart) {
		print ("Odczekaj minutę a następnie odświerz <br>interfejs klikając w poniższy link<br>");
		print ("<a href = index.php>".REFRESH_LABEL."</a><br>");
		break;
	}
	*/
	
	if (!$isaction){
		print ("Listwa gotowa !");
	} 
	
	
	$stateByte = getGPIOstate();
	print "<br>stateByte = 0x".bin2hex($stateByte)."<br>";
	/*
	print "active1 = ".$active1."<br>";
	print "active2 = ".$active2."<br>";
	print "active3 = ".$active3."<br>";
	print "active4 = ".$active4."<br>";
	*/
	print "</font>";
	print "</td></tr>";

	$stateByteDec = hexdec(bin2hex($stateByte));

	$active1 = strlen(CHANNEL1_LABEL);
	$active2 = strlen(CHANNEL2_LABEL);
	$active3 = strlen(CHANNEL3_LABEL);
	$active4 = strlen(CHANNEL4_LABEL);

	$bg1col = BG_OFF_COL;
	$bg2col = BG_OFF_COL;
	$bg3col = BG_OFF_COL;
	$bg4col = BG_OFF_COL;
	
	$action1 = GPIO_ON_COMMAND."1";
	$action2 = GPIO_ON_COMMAND."2";
	$action3 = GPIO_ON_COMMAND."3";
	$action4 = GPIO_ON_COMMAND."4";
	
	if (checkIfBitSet($stateByteDec,PIN1_BIT)){
		$bg1col = ($active1) ? BG_ON_COL : BG_OFF_COL;
		$action1 = GPIO_OFF_COMMAND."1";
	}

	if (checkIfBitSet($stateByteDec,PIN2_BIT)){
		$bg2col = ($active2) ? BG_ON_COL : BG_OFF_COL;
		$action2 = GPIO_OFF_COMMAND."2";	
	}

	if (checkIfBitSet($stateByteDec,PIN3_BIT)){
		$bg3col = ($active3) ? BG_ON_COL : BG_OFF_COL;
		$action3 = GPIO_OFF_COMMAND."3";
	}

	if (checkIfBitSet($stateByteDec,PIN4_BIT)){
		$bg4col = ($active4) ? BG_ON_COL : BG_OFF_COL;
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
	print "<a href = index.php?action=shutdown><font size = ".FONT_SIZE." face = ".FONT_FACE.">".SHUTDOWN_LABEL."</font></a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50%>";
	print "<a href = index.php?action=reboot><font size = ".FONT_SIZE." face = ".FONT_FACE.">".REBOOT_LABEL."</font></a></td></tr>";

	print "<td align = center valign = middle height = ".CELL_HEIGHT." colspan = 2>";
	print "<a href = index.php><font size = ".FONT_SIZE." face = ".FONT_FACE.">".REFRESH_LABEL."</font></a></td></tr>";

	
	
	} while (0);
	
	print "</td></tr></table>";
	print "</center>";
	
	?>
   </body>
</html>
