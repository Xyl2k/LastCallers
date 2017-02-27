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

	if (isset($_SERVER['REMOTE_ADDR'])){
		$ip = $_SERVER['REMOTE_ADDR'];}
	    else {
        $ip = ''; }
		$date = time();

		
		require_once('data/geoip.inc');
		$geoip = geoip_open("data/GeoIP.dat", GEOIP_STANDARD);
		
		$country = geoip_country_code_by_addr($geoip, $ip);
						
		if (($country == '') || ($country == 'a1')) {
			$country = 'xx';
		}
		geoip_close($geoip);
		
		$ipfinal = substr(htmlentities($ip), 0, 8) . "..";

		mysqli_query($mysql, "CALL remove_last_ip();");
		$ret = mysqli_query($mysql, "INSERT INTO lastcallers VALUES(NULL, '" . mysqli_real_escape_string($mysql, $ipfinal) . "', '" . $country . "', '" . mysqli_real_escape_string($mysql, $date) . "')") or die(mysqli_error($mysql));

?>