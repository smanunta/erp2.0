<?php
require('../../includes/functions.php');
require('../../includes/checklogin.php');
require('../../includes/dblogin.php');
?>
<script type= "text/javascript" src="./widgets/search_view/search_ajax.js"></script>
<script type="text/javascript">
	$('#search_all').parent().css('display' , 'none');
</script>

<div id="main_search_page">
	<div id="search_box">		<!--using the onkeyup function to detect when keys are presed to run code-->
		<input id="userInput" type="text" name="userInput" onkeyup="process_search()"/><button type="button" id="main_search_button"><span aria-hidden='true' class='icon-search'></span></button>
	</div>	
	<label>In: </label>
		<select id="userOptions" name="userOptions">
  				<option value="find_users">Users</option>
  				<option value="find_config_item">Config item</option>
				<option value="find_wo">Work Orders</option>
		</select>
</div>

<div id="underInput"></div>

