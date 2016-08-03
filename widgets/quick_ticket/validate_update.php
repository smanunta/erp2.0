<?php
    require('../../includes/functions.php'); 
	require('../../includes/checklogin.php'); 
	require('../../includes/dblogin.php'); 
     
 if(isset($_POST['id']))
    {
        $query = "SELECT * FROM work_orders WHERE id='{$_POST['id']}'";
        $order_info = mysqli_query($GLOBALS['link'], $query);
        $data= mysqli_fetch_array($order_info);

	$ci_query= "SELECT * FROM configuration_item WHERE id='{$data['ci_id']}'";
        $ci_info= mysqli_query($GLOBALS['link'], $ci_query);
        $ci_data= mysqli_fetch_array($ci_info);

	$user_query= "SELECT * FROM users WHERE user_id='{$data['user_id']}'";
        $user_info= mysqli_query($GLOBALS['link'], $user_query);
        $user_data= mysqli_fetch_array($user_info);
		
	$created_by_query = "SELECT * FROM users WHERE user_id='{$data['created_by']}'";
        $created_by_info= mysqli_query($GLOBALS['link'], $created_by_query);
        $created_by_data= mysqli_fetch_array($created_by_info);
    }


	if($_POST != NULL)
	{
    		$update_data= array();
		
		/*--------THIS EXPLODES THE USERS NAME AND CREATES AN ARRAY TO CHECK IF CHANGES WERE MADE AND UPDATES THE USER----*/
		$names = explode(" ", $_POST['name']);
    		if($user_data['last'] != $names[1] && $user_data['first'] != $names[0])
    		{
       			$query= "SELECT * FROM users WHERE last='$names[1]' AND first='$names[0]' LIMIT 1";
			$run_query= mysqli_query($GLOBALS['link'], $query);
			$user_data= mysqli_fetch_array($run_query);
			$update_data []= "user_id= '" . $user_data['user_id'] . "'";
    		}
		if($ci_data['item'] != $_POST['ci_data'])
    		{
			$new_ci = $_POST['ci_data'];
       			$query= "SELECT * FROM configuration_item WHERE item='$new_ci' LIMIT 1";
			$run_query= mysqli_query($GLOBALS['link'], $query);
			$ci_data= mysqli_fetch_array($run_query);
			$update_data[]= "ci_id= '" . $ci_data['id'] . "'";
    		}
    		if($data['description'] != $_POST['description'])
    		{
        		$update_data[]= "description = '" . $_POST['description'] . "'";
    		}
   	 	if($data['urgency'] != $_POST['urgency'])
    		{
       			 $update_data[]= "urgency = '" . $_POST['urgency'] . "'";
    		}
    		if($data['impact'] != $_POST['impact'])
    		{
        		$update_data[]= "impact = '" . $_POST['impact'] . "'";
    		}
    		if($data['state'] != $_POST['state'])
	    	{   
        		$update_data[]= "state = '" . $_POST['state'] . "'";
	    	}
			if($data['assigned_group'] != $_POST['assigned_group'])
			{
				$update_data[]= "assigned_group = '" . $_POST['assigned_group'] . "'";
			}
			$update_data[]= "submited = '1'";
		
		$update_data_string = implode(", ", $update_data);
		$wo_id = $data['id'];

		if($update_data_string != NULL)
		{
			$wo_query= "UPDATE work_orders SET $update_data_string WHERE id = $wo_id";
    			$wo_data_entry = mysqli_query($GLOBALS['link'], $wo_query);
			/*$("#submit_data").click(function(){ $("#update").submit(); });*/
		}

	/* -------------------------------THIS ENDS work_order TABLE UPDATES-------------------------------*/    		
		
				
		if(isset($_POST['id']))
    	{
			new_note($_POST['new_notes'], $_POST['id'], $_SESSION['user_id']);
		}


    }

?>