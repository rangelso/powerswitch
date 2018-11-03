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
	require(PHP_PATH.'functions.php'); 
	
	print "<center>";
	if(isset($_GET['action'])){
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
		}
	} else {
		print ("Dioda gotowa");
	}
	print "</center>";
	
	$stateByte = getGPIOstate();
	print "stateByte from bindec = ".bindec($stateByte)."<br>";  
	print "stateByte from bin2hex = ".bin2hex($stateByte)."<br>";  
	    
	?>
	 
	 <table border = 0 cellspacing = 0 cellpadding = 0 width = 100%>
		<tr >
			<td height = 30 colspan=2>
			&nbsp;
	 		</td>
		</tr>
		<tr>
			<td align=center height = 100 valign = middle>
				<a href = index.php?action=turnon1>Włącz gniazdo 1</a><br><br>
				<a href = index.php?action=turnoff1>Wyłącz gniazdo 1</a>
			</td>
			<td align=center height = 100 valign = middle>
				<a href = index.php?action=turnon2>Włącz gniazdo 2</a><br><br>
				<a href = index.php?action=turnoff2>Wyłącz gniazdo 2</a>
			</td> 
		</tr>
		<tr>
			<td align=center height = 100 valign = middle>
				<a href = index.php?action=turnon3>Włącz gniazdo 3</a><br><br>
				<a href = index.php?action=turnoff3>Wyłącz gniazdo 3</a>
			</td>
			<td align=center height = 100 valign = middle>
				<a href = index.php?action=turnon4>Włącz gniazdo 4</a><br><br>
				<a href = index.php?action=turnoff4>Wyłącz gniazdo 4</a>
			</td> 
		</tr>
		<tr>
			<td align=center height = 30 colspan=2>
				<a href = index.php?action=turnonall>Włącz wszystkie</a><br><br>
				<a href = index.php?action=turnoffall>Wyłącz wszystkie</a>
	 		</td>
		</tr>
	 </table>
   </body>
</html>
