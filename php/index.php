<html>
 <head>
  <title>Test diody</title>
 </head>
 <body>
	 <?php
	ini_set('error_reporting',E_ALL);
	ini_set('display_errors',1);

	print "<center>";
	if(isset($_GET['action'])){
		if ($_GET['action']=="turnon1") {
			system("/var/www/html/test-rasp1 turnon1");
			//echo exec("test-rasp1 turnon");
		} else if ($_GET['action']=="turnoff1") {
			system("/var/www/html/test-rasp1 turnoff1");
		} else if ($_GET['action']=="turnon2") {
			system("/var/www/html/test-rasp1 turnon2");
		} else if ($_GET['action']=="turnoff2") {
			system("/var/www/html/test-rasp1 turnoff2");
		} if ($_GET['action']=="turnon3") {
			system("/var/www/html/test-rasp1 turnon3");
		} else if ($_GET['action']=="turnoff3") {
			system("/var/www/html/test-rasp1 turnoff3");
		} if ($_GET['action']=="turnon4") {
			system("/var/www/html/test-rasp1 turnon4");
		} else if ($_GET['action']=="turnoff4") {
			system("/var/www/html/test-rasp1 turnoff4");
		}
	} else {
		print ("Dioda gotowa");
	}
	print "</center>";    
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
			<td height = 30 colspan=2>
			&nbsp;
	 		</td>
		</tr>
	 </table>
   </body>
</html>
