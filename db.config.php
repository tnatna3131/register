<?php
// Verify the php_mssql libary is installed and enabled.
if(!function_exists('mssql_connect')){
	echo 'You must have the php_mssql library for Apache installed and enabled to connect to an MSSQL database.  Uncomment the line that says extension=php_mssql.dll in your php.ini (XAMPP/WAMP only).  This requires a restart of the Apache service to take effect.'; die();
}
// Database configuration parameters
$db_host = '127.0.0.1';
$db_user = 'Shaiya';
$db_pass = 'Shaiya123';

/**
 * Sanitize user input to prevent SQL injection.  Use this on ALL user input!
 * This function is from CodeIgniter.
 * I researched other methods of doing this, and this looked the most solid to me - Abrasive
 * @param string $data
 * @return string
 */
function mssql_escape_string($data) {
	if(!isset($data) or empty($data)) return '';
	if(is_numeric($data)) return $data;
	$non_displayables = array(
		'/%0[0-8bcef]/',			// url encoded 00-08, 11, 12, 14, 15
		'/%1[0-9a-f]/',				// url encoded 16-31
		'/[\x00-\x08]/',			// 00-08
		'/\x0b/',					// 11
		'/\x0c/',					// 12
		'/[\x0e-\x1f]/'				// 14-31
	);
	foreach($non_displayables as $regex)
		$data = preg_replace($regex,'',$data);
		$data = str_replace("'","''",$data);
	return $data;
}
?>