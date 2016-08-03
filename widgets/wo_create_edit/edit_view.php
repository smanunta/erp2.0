<?php
    require('../../includes/functions.php'); 
	require('../../includes/checklogin.php'); 
	require('../../includes/dblogin.php'); 
     
 if(!isset($_GET['id']))
	{
		$user_id_from_sess = $_SESSION['user_id'];
		$new_incident_query = "INSERT INTO work_orders (id, created_by) VALUES ('NULL', '$user_id_from_sess')";
		$run_new_incident_query = mysqli_query($GLOBALS['link'], $new_incident_query);
		$new_id = mysqli_insert_id($GLOBALS['link']);
	}
 if(isset($_GET['id']))
    {
        $query = "SELECT * FROM work_orders WHERE id='{$_GET['id']}'";
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
 if(isset($new_id))
    {
        $query = "SELECT * FROM work_orders WHERE id='{$new_id}'";
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
    						
		if(isset($new_id))
    	{
			new_note($_POST['new_notes'], $new_id, $_SESSION['user_id']);
		}

 if(isset($_GET['id']))
    {
        $query = "SELECT * FROM work_orders WHERE id='{$_GET['id']}'";
        $order_info = mysqli_query($GLOBALS['link'], $query);
        $data= mysqli_fetch_array($order_info);

	$ci_query= "SELECT * FROM configuration_item WHERE id='{$data['ci_id']}'";
        $ci_info= mysqli_query($GLOBALS['link'], $ci_query);
        $ci_data= mysqli_fetch_array($ci_info);

	$user_query= "SELECT * FROM users WHERE user_id='{$data['user_id']}'";
        $user_info= mysqli_query($GLOBALS['link'], $user_query);
        $user_data= mysqli_fetch_array($user_info);
    }



?>
<head>
    <link rel="stylesheet" type="text/css" href="http://josesebastianmanunta.com/erp2.0/css/design.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
     <script src="http://josesebastianmanunta.com/erp2.0/javascript/javascript_functions.js"></script>
</head>
    <title>Order <?php echo $_GET['id']; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/tabs.css">
	 <script type="text/javascript" src="edit_view.js"></script>
	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>
		tinymce.init({
		selector: "div.new_note",
		theme: "modern",
		plugins: [
			["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker"],
			["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
			["save table contextmenu directionality emoticons template paste"]
		],
		add_unload_trigger: false,
		schema: "html5",
		inline: true,
		toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image     | print preview media",
		statusbar: false
	});

	tinymce.init({
		selector: "h1.edit",
		theme: "modern",
		add_unload_trigger: false,
		schema: "html5",
		inline: true,
		toolbar: "undo redo",
		statusbar: false
	});
	</script> 

	<div class="wrapper">
         <div id="top_sec">
            <div class="left">
                <h3>Edit View</h3>
            </div>
            <div class="right">
                <ul>
                    <li class="top_right">
						<button id="submit_data" onClick="ajax_post_data()">Submit Data</button>
                    </li>
                    <li class="top_right">
                        
                    </li>
                </ul>
            </div>
	</div>


		<div id="first_sec">       <!--FIRST SECTION IN THE WO INCLUDES MULTIPLE FIELDS-->
            <div class="imp_left">
                <ul>
                    <li class="ord_id <?php echo $data['id']; ?>">
                        <label>Order ID: </label><h2 id="order_id"><?php echo $data['id']; ?></h2>
                    </li>
                    <li class="ord_id <?php echo $user_data['last']; ?>">
                        <label>User:</label></label><input type="text" id="user_id" name="name" value="<?php if($user_data['user_id'] != 0){echo $user_data['first'] . ' ' . $user_data['last'];} ?>">
                    </li>
                    <li class="ord_id <?php echo  $ci_data['item']; ?>">
                        <label>CI:</label><input type="text" id="config_item" name="ci_data" value="<?php echo $ci_data['item']; ?>">
                    <li class="ord_id">
			<label>Group:</label>
			<select name="assigned_group">
  				<option value="<?php echo $data['assigned_group']; ?>" selected><?php echo $data['assigned_group']; ?></option>
 			 	<option value="IT Level I">IT Level I</option>
  				<option value="IT Level II">IT Level II</option>
  				<option value="IT Level III">IT Level III</option>
			</select>
                    </li>
                </ul>
            </div>
            <div class="imp_right">
                <ul>
					<li class="ord_id">
                         <label>Created by: </label><?php echo $created_by_data['last'] .", ". $created_by_data['first']; ?>    <!--**************DOES NOT CHANGE AFTER CREATION**************-->
                    </li>
                    <li class="ord_id">
                         <label>Open date: </label><?php echo $data['open date']; ?>
                    </li>
                    <li class="ord_id">
                        <label>Urgency:</label>
			<select name="urgency">
  				<option value="<?php echo $data['urgency'] ?>" selected><?php echo $data['urgency'] ?></option>
 			 	<option value="1">1</option>
  				<option value="2">2</option>
  				<option value="3">3</option>
			</select>
                    </li>
                    <li class="ord_id <?php echo $data['impact']; ?>">
			<label>Impact:</label>
			<select name="impact">
  				<option value="<?php echo $data['impact']; ?>" selected><?php echo $data['impact']; ?></option>
 			 	<option value="1">1</option>
  				<option value="2">2</option>
  				<option value="3">3</option>
			</select>

                    </li>
                    <li class="ord_id <?php echo $data['state']; ?>">
			<label>State:</label>
			<select name="state">
  				<option value="<?php echo $data['state']; ?>" selected><?php echo $data['state']; ?></option>
 			 	<option value="Open">Open</option>
  				<option value="Closed">Closed</option>
  				<option value="Work in Progress">Work in Progress</option>
			</select>

                    </li>
                    <li>
                        
                    </li>
                   <li>
                        
                    </li>
                </ul>
            </div>
	<div class=imp_whole>
            <ul>
                <li class="short_descrip">
                    <label>Description:</label><input type="text" name="description" value="<?php echo $data['description']; ?>">
                </li>
                <li class="new_notes">
                    <label>Notes:</label><input type="text" id="new_notes" name="new_notes">
					<div class="new_note">hello this is a test for note editing with tiny mce</div>
                </li>
            </ul>
	</div>        </div>
        <div id="second_sec">
          <div id="tabbed_menu">
                    <ul class='tabs'>
                       <li class='TEST' data-this-tab='notes'>
                        <span>Notes</span>
                       </li>
                       <li class='TEST' data-this-tab='other_tickets'>
                        <span>Users Other tickets</span>
                       </li>
                       <li class='TEST' data-this-tab='workflow'>
                        <span>Workflow</span>
                       </li>
                       <li class='TEST' data-this-tab='assets'>
                        <span>Assets</span>
                       </li>
                       <li class='TEST' data-this-tab='contact'>
                        <span>Contact info</span>
                       </li>
                    </ul>
</div>
<div id='tabs_data'>
  <div class="notes"><?php if(isset($new_id)){notes($new_id);}if(isset($_GET['id'])){notes($_GET['id']);} ?></div>
  <div class="other_tickets"><?php other_tickets(); ?></div>
  <div class="workflow"><?php workflow(); ?></div>
  <div class="assets"><?php assets(); ?></div>
  <div class="contacts"><?php contact(); ?></div>
</div>
        </div>
    </div>
</body>
</html>