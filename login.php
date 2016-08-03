<?php 
session_save_path("/home/users/web/b966/ipg.josesebastianmanunta/cgi-bin/tmp");
session_start();
require "includes/functions.php";
require "includes/dblogin.php";

if(isset($_POST['submit']))
{
    $query = "SELECT username, password FROM users WHERE username='{$_POST['username']}' AND password='{$_POST['password']}' LIMIT 1";

    $userdata=mysqli_query($link, $query);
    if(!$userdata){
   die("database query fail.");
     }

 $user = mysqli_fetch_array($userdata);

 if($user['username'] == $_POST['username'] && $user['password'] == $_POST['password'])
           { 
                $query = "SELECT * FROM users WHERE username='{$_POST['username']}' AND password='{$_POST['password']}' LIMIT 1";
		$userdata=mysqli_query($link, $query);
		$user = mysqli_fetch_array($userdata);

                $_SESSION['username'] = $user['username'];
                $_SESSION['password']= $user['password'];
		$_SESSION['user_id']= $user['user_id'];
                redirect('http://smanunta.com/erp2.0/index.php');
            }
 else
            {
              echo " Wrong username or password";
            }
}
?>

<form action="login.php" method="POST">
username: <input type='text' name='username' value=''>
password: <input type='text' name='password' value=''>

<input type='submit' name='submit' value='submit'>
</form>