<?php 
$link = mysqli_connect("josesebastianmanunta.ipagemysql.com", "smanunta", "Jsm2116234.", "erp"); 
if (mysqli_connect_errno()) {

die("DB connection failed:" . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");

}
?> 