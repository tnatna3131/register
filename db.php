<?php
// Connect to MSSQL server - I used an @ symbol to suppress error messages here to avoid giving away the account name in the case of an error.
$conn = @mssql_connect($db_host,$db_user,$db_pass) or die('Failed to connect to MSSQL Server.');
$db = @mssql_select_db('PS_UserData',$conn) or die('Failed to select database PS_UserData.');
?>
