<?php
require_once('db.config.php');
require_once('db.php');

$user_ip = $_SERVER['REMOTE_ADDR'];
$username = isset($_POST['username']) ? mssql_escape_string(trim($_POST['username'])) : '';
$password = isset($_POST['password']) ? mssql_escape_string(trim($_POST['password'])) : '';
$password2 = isset($_POST['password2']) ? mssql_escape_string(trim($_POST['password2'])) : '';
$errors = array();
$success = false;

if(isset($_POST) && !empty($_POST)){

    // Validate user name.
    $result = @mssql_query("SELECT UserID FROM PS_UserData.dbo.Users_Master WHERE UserID = '{$username}'") or die('Failed to verify is the provided user named already exists.');
    if(empty($username)){
        $errors[] = 'Please provide a user name.';
    }else if(strlen($username) < 3 || strlen($username) > 16){
        $errors[] = 'User name must be between 3 and 16 characters in length.';
    }else if(ctype_alnum($username) === false){
        $errors[] = 'User name must consist of numbers and letters only.';
    }else if(mssql_num_rows($result)){
        $errors[] = 'User name already exists, please choose a different user name.';
    }

    // Validate user password.
    if(empty($password)){
        $errors[] = 'Please provide a password.';
    }else if(strlen($password) < 3 || strlen($password) > 16){
        $errors[] = 'Password must be between 3 and 16 characters in length.';
    }else if($password != $password2){
        $errors[] = 'Passwords do not match.';
    }

    // Persist the new account to the database if no previous errors occured.
    if(count($errors) == 0){
        $sql = "INSERT INTO PS_UserData.dbo.Users_Master
                (UserID,Pw,JoinDate,Admin,AdminLevel,UseQueue,Status,Leave,LeaveDate,UserType,Point,EnPassword,UserIp)
                VALUES ('{$username}','{$password}',GETDATE(),0,0,0,0,0,GETDATE(),'N',0,'','{$user_ip}')";
        if($result = @mssql_query($sql)){
            $success = "Account {$username} successfully created!";
        }else{
            $errors[] = 'Failed to create a new account, please try again later';
        }
    }
}

// Determine which view to show.
if($success === false){
    require_once('register.view.php');
}else{
    require_once('success.view.php');
}
?>
