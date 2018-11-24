<html>
 <head>
  <title>PANEL STEROWANIA PI@POWERBOX4 DLA CHATA ANI</title>
 </head>
 <body background = img/blue.jpg>
	<script language =javascript>
		
	function postAction(action){
		switch (action) {
			case "turnon1":
			case "turnoff1":
				document.action1form.submit();
			break;
			case "turnon2":
			case "turnoff2":
				document.action2form.submit();
			break;
			case "turnon3":
			case "turnoff3":
				document.action3form.submit();
			break;
			case "turnon4":
			case "turnoff4":
				document.action4form.submit();
			break;
			case "turnonall":
				document.action5form.submit();
			break;
			case "turnoffall":
				document.action6form.submit();
			break;
			case "shutdown":
				document.action7form.submit();
			break;
			case "reboot":
				document.action8form.submit();
			break;
		}
	}
	</script>
	
	<?php
	
	ini_set('error_reporting',E_ALL);
	ini_set('display_errors',1);
			
	define('HTML_PATH', '/var/www/html/');
	define('PHP_PATH', HTML_PATH.'php/');
	
	require(PHP_PATH.'config.php'); 	
	require(PHP_PATH.'functions.php'); 
	$isaction = 0;
		
	do {
		
		print "<center>";
		print "<table border = 1 cellspacing = 5 cellpadding = 5 width = 800>";
		print "<tr><td align = center valign = middle colspan=2 height = 50 bgcolor=".BG_OFF_COL.">";
		print "<font size = 2 face = ".FONT_FACE." color=black>";
						
		if(isset($_POST['action'])){
			$isaction = 1;
			if ($_POST['action']=="turnon1") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."1");
			} else if ($_POST['action']=="turnoff1") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."1");
			} else if ($_POST['action']=="turnon2") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."2");
			} else if ($_POST['action']=="turnoff2") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."2");
			} else if ($_POST['action']=="turnon3") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."3");
			} else if ($_POST['action']=="turnoff3") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."3");
			} else if ($_POST['action']=="turnon4") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."4");
			} else if ($_POST['action']=="turnoff4") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."4");
			} else if ($_POST['action']=="turnonall") {
				system(GPIO_APP_FILE_PATH." ".GPIO_ON_COMMAND."all");
			} else if ($_POST['action']=="turnoffall") {
				system(GPIO_APP_FILE_PATH." ".GPIO_OFF_COMMAND."all");
			} else if ($_POST['action']=="shutdown") {
				$shutdown = shell_exec('sudo shutdown -h -P now');
			} else if ($_POST['action']=="reboot") {
				$shutdown = shell_exec('sudo reboot');
			}
		} 
	
			
	if (!$isaction){
		print ("Listwa gotowa !");
	} 
	
	$stateByte = getGPIOstate();
	//print "<br>stateByte = 0x".bin2hex($stateByte)."<br>";
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

	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".$bg2col.">";
	print "<a href = javascript:postAction(&quot;".$action2."&quot;)><font size = ".FONT_SIZE." face = ".FONT_FACE.">".CHANNEL2_LABEL."</font></a></td>";
		
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".$bg1col.">";
	print "<a href = javascript:postAction(&quot;".$action1."&quot;)><font size = ".FONT_SIZE." face = ".FONT_FACE.">".CHANNEL1_LABEL."</font></a></td></tr>";
	
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".$bg3col.">";
	print "<a href = javascript:postAction(&quot;".$action3."&quot;)><font size = ".FONT_SIZE." face = ".FONT_FACE.">".CHANNEL3_LABEL."</font></a></td>";
		
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".$bg4col.">";
	print "<a href = javascript:postAction(&quot;".$action4."&quot;)><font size = ".FONT_SIZE." face = ".FONT_FACE.">".CHANNEL4_LABEL."</font></a></td></tr>";
	
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".BG_OFF_COL.">";
	print "<a href = javascript:postAction(&quot;turnonall&quot;)><font size = ".FONT_SIZE." face = ".FONT_FACE.">".ALL_ON_LABEL."</font></a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".BG_OFF_COL.">";
	print "<a href = javascript:postAction(&quot;turnoffall&quot;)><font size = ".FONT_SIZE." face = ".FONT_FACE.">".ALL_OFF_LABEL."</font></a></td></tr>";
	
	print "<tr><td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".BG_OFF_COL.">";
	print "<a href = javascript:postAction(&quot;shutdown&quot;)><font size = ".FONT_SIZE." face = ".FONT_FACE.">".SHUTDOWN_LABEL."</font></a></td>";
	
	print "<td align = center valign = middle height = ".CELL_HEIGHT." width = 50% bgcolor=".BG_OFF_COL.">";
	print "<a href = javascript:postAction(&quot;reboot&quot;)><font size = ".FONT_SIZE." face = ".FONT_FACE.">".REBOOT_LABEL."</font></a></td></tr>";

	print "<td align = center valign = middle height = ".CELL_HEIGHT." colspan = 2 bgcolor=".BG_OFF_COL.">";
	print "<a href = index.php><font size = ".FONT_SIZE." face = ".FONT_FACE.">".REFRESH_LABEL."</font></a></td></tr>";
	
	} while (0);
	
	print "</td></tr></table>";
	print "</center>";
	
	print "<form name = action1form action = index.php method = post>";
	print "<input type = hidden name = action value = ".$action1.">";
	print "</form>";
	print "<form name = action2form action = index.php method = post>";
	print "<input type = hidden name = action value = ".$action2.">";
	print "</form>";
	print "<form name = action3form action = index.php method = post>";
	print "<input type = hidden name = action value = ".$action3.">";
	print "</form>";
	print "<form name = action4form action = index.php method = post>";
	print "<input type = hidden name = action value = ".$action4.">";
	print "</form>";
	print "<form name = action5form action = index.php method = post>";
	print "<input type = hidden name = action value = turnonall>";
	print "</form>";
	print "<form name = action6form action = index.php method = post>";
	print "<input type = hidden name = action value = turnoffall>";
	print "</form>";
	print "<form name = action7form action = index.php method = post>";
	print "<input type = hidden name = action value = shutdown>";
	print "</form>";
	print "<form name = action8form action = index.php method = post>";
	print "<input type = hidden name = action value = reboot>";
	print "</form>";
	
	?>
   </body>
</html>
