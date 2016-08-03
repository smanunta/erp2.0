<?php
	
header('Content-Type: text/xml');
	
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

echo '<response>';

	$search_parameter = $_GET['search_parameter'];
	$search_function = $_GET['search_type'];
	
	if($search_parameter != "")
	{echo "this is working" . $search_parameter . " " . $search_function;
		include('../../includes/functions.php');
		include('../../includes/checklogin.php');
		include('../../includes/dblogin.php');
	
		$search = new search_all_page;
		
		$function = $search->$search_function($search_parameter);

		//include if statements depending on the $search_function for diff outputs
		if($search_function == 'find_config_item')  //FIND CONFIG ITEMS----
		{
			echo '<find_config_item>';
			foreach($function as $val)  // $val will be an array that contains user info
			{
				echo  "<item>" . $val[0] . "</item>";
				echo "<description>" .$val[1] . "</description>";
			}
			echo '</find_config_item>';
		}
		elseif($search_function == 'find_users')  //FIND USERS FUNCTION-----
		{
			echo '<find_users>';
			foreach($function as $val)  // $val will be an array that contains user info
			{
				echo  "<first>" . $val[0] . "</first>";
				echo "<last>" .$val[1] . "</last>";
				echo "<username>" . $val[2] . "</username>";
			}
			echo '</find_users>';
		}
		elseif($search_function == 'find_wo')
		{
			echo '<work_orders>';
			foreach($function as $val)  // $val will be an array that contains user info
			{
				echo  "<wo_id>" . $val[0] . "</wo_id>";
				echo "<description>" .$val[1] . "</description>";
				echo "<first>" . $val[2] . "</first>";
				echo "<last>" . $val[3] . "</last>";
			}
			echo '</work_orders>';
		}
	}
	elseif($search_parameter == "")
	{	
		echo "ENTER A SEARCH PARAMETER";
	}
	else
	{
		echo "NOTHING HAS BEEN FOUND";
	}

echo '</response>';

?>