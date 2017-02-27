<?php
	// SQL db info
	define('MYSQL_HOST',  'localhost');
	define('MYSQL_USER',  'root');
	define('MYSQL_PASS',  '');
	define('MYSQL_DB',    'lastcall');
	
	$mysql = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
	
	/* Vérification de la connexion */
	if (mysqli_connect_errno()) {
    printf("Mysql fail: : %s\n", mysqli_connect_error());
    exit();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title>LAST CALLERS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="shortcut icon" href="data/favicon.ico">
    <link rel='stylesheet' href='data/css/style.css' type='text/css'>
</head>

<body>
	<!-- BEGIN LAST CALLER -->
	<div class="sidebar_wrap">
		<div class="sidebar_headline">LAST CALLERS</div>
		<div class="sidebar_blenk"></div>
			<?php	
			$ret = mysqli_query($mysql, 'SELECT * FROM lastcallers ORDER BY ip_date DESC LIMIT 10');	
			while (($row = mysqli_fetch_assoc($ret)) !== null) {
			$flag = '<img src="data/imgs/flags/' . strtolower($row['ip_flag']) . '.png" title="' . strtoupper($country) .'"/>';		
			if (!empty($row['ip_call'])) { ?>
<div class="sidebar_ip"><?php echo($flag . " " . substr(htmlentities($row['ip_call']), 0, 8) . ".."); ?></div>
		<div class="sidebar_date"><?php echo(date('H:i', intval($row['ip_date']))); ?></div>
			<?php } 
			}
			mysqli_free_result($ret);
			?>
<div style="width: 200px; height: 14px; background: #000a22; float: left;"></div>
	</div>
	<!-- END LAST CALLER -->
</body>

</html>