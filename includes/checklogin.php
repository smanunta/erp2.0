<?php
session_save_path("/home/users/web/b966/ipg.josesebastianmanunta/cgi-bin/tmp");
session_start();
if(!isset($_SESSION['username']))
{
 redirect('http://smanunta.com/erp2.0/login.php'); 
}

?>