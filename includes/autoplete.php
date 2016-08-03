<?php 
	require('./functions.php');
	require('./checklogin.php');
	require('./dblogin.php');
	
	if(isset($_GET['user_id']))
	{
	$user = new users();
	
	echo json_encode($user->find_users($_GET['term']));
	}

	if(isset($_GET['config_item']))
	{
	$config_item = new auto_ci();

	echo json_encode($config_item->find_config_item($_GET['term']));
	}

	if(isset($_GET['main_search']))
	{
	$search_item = new search_all();

	echo json_encode($search_item->$_GET['option']($_GET['term']));
	}
	
?>	
