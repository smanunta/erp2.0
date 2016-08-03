<?php

require('functions.php');
require('checklogin.php');
require('dblogin.php');
?>
<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/design.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
     <script src="./javascript/javascript_functions.js"></script>
</head>

<body>

<header>
<div id="nav_page">
    <div class="logo">
         <h2>My ERP</h2>
    </div>
    <div class="account">
                 <ul id="topbar_list">
                    <li class="topbar">Logged in: <?php echo $_SESSION['username'] ?></li>
                    <li class="topbar"><a href="./signout.php">Sign out</a></li>
                    <li class="topbar"><a href="./account.php">Account</a></li>
                </ul>
	</div>
	<div id="nav">
		<?php   side_menu();  ?>
	</div>
</div>
</header>

<div id="right_wrapper">  <!-- this will wrap the entire right side-->
<div class="wrapper">
<div id="search_all">
	<form name="search_all" action="http://josesebastianmanunta.com/erp/pages/search_view.php" method="POST">
		<label>Search: </label><input id="main_search" type="text" name="search_parameter">
		<label>In: </label>
		<select id="search_option" name="category" form="update">
  				<option value="find_users">Users</option>
  				<option value="find_config_item">Config item</option>
			</select>
		<input type="submit" value="Submit">
	</form>
</div>
</div>