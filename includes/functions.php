<?php

function redirect($url) {
    if(!headers_sent()) {
        //If headers not sent yet... then do php redirect
        header('Location: '.$url);
        exit;
    } else {
        //If headers are sent... do javascript redirect... if javascript disabled, do html redirect.
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';
        exit;
    }
}

function side_menu()
{
 $query = "SELECT * FROM menu WHERE (user_id = '{$_SESSION['user_id']}' OR user_id = '0') ";
 $result = mysqli_query($GLOBALS['link'], $query);

 $query_options = "SELECT * FROM menu_options";
 $options_result = mysqli_query($GLOBALS['link'], $query_options);
 $name = array();
 $absolute_link = array();
 $i= "1";
 while($options = mysqli_fetch_array($options_result))
 {
   $name[$i]= $options['name'];
   $absolute_link[$i]= $options['page_link'];
   $i++;
 }
 if(!$result)
{
die("not working");
}
$i = "1";
while($results = mysqli_fetch_array($result))
 {
    
    echo  "<ul  class='maina'>";
    echo   "<li class='main' id='". $results['main'] . "'>" . $results['main'] . "<span aria-hidden='true' class='icon-menu1'></span></li>";
    echo  "<ul class='subs" . $i . "'>";
  if($results['sub1'] != NULL)
    {
      $index = $results['sub1'];
      echo   "<li class='" . $results['sub1'] . "'><a href='" . $absolute_link[$index] . "'>" . $name[$index] . "</a></li>"; 
    }
 if($results['sub2'] != NULL)
    {
      $index = $results['sub2'];
      echo   "<li class='" . $results['sub2'] . "'><a href='" . $absolute_link[$index] . "'>" . $name[$index] . "</a></li>";
    }
 if($results['sub3'] != NULL)
    {
      $index = $results['sub3'];
      echo   "<li class='" . $results['sub3'] . "'><a href='" . $absolute_link[$index] . "'>" . $name[$index] . "</a></li>"; 
    }
 if($results['sub4'] != NULL)
    {
      $index = $results['sub4'];
      echo   "<li class='" . $results['sub4'] . "'><a href='" . $absolute_link[$index] . "'>" . $name[$index] . "</a></li>"; 
    }
    echo "</ul>";
    echo "</ul>";
    $i += $i;
 }
  echo "<ul class='maina create_menu'>";
  echo   "<li class='main new_menu'>Create a new menu</li>";
  echo "<ul>";
  echo   "<li class='create_new_menu'><a href='http://josesebastianmanunta.com/erp/pages/new_menu.php' target='_blank'>Create a new menu</a></li>";
  echo   "<li class='create_new_menu'><a href='http://josesebastianmanunta.com/erp2.0/widgets/wo_create_edit/edit_view.php' target='_blank'>Create a new Incident</a></li>";
  echo "</ul>";
  echo "</ul>";
  
   echo "<ul class='maina widgets'>";
  echo   "<li class='main'>widgets</li>";
  echo "<ul>";   //	THIS WILL HAVE TO BE AUTOMATED BY GOING INTO FOLDER AND GETTING NAMES
  echo   "<li><a href='#search_view'>Search All</a></li>";
  echo   "<li><a href='#quick_notes'>Quick Notes</a></li>";
  echo "</ul>";
  echo "</ul>";
}
/*--------------------------------------------------------------------------------------------------*/
function show_wo () 
{
     $query="SELECT * FROM work_orders WHERE submited = '1'";
     $result= mysqli_query($GLOBALS['link'], $query);
  
     while($results=mysqli_fetch_array($result))
      {
         $user_query= "SELECT * FROM users WHERE user_id='{$results['user_id']}'";
         $user_info= mysqli_query($GLOBALS['link'], $user_query);
         $user_data= mysqli_fetch_array($user_info);

         echo "<ul class='rows'>";
            echo "<li class='wo_id inline'><a href='widgets/wo_create_edit/edit_view.php?id=" . $results['id'] . "' target='_blank'>" . $results['id'] . "</a></li>";
            echo "<li class='user inline'><span>" . $user_data['last'] . "," . $user_data['first'] . "</span></li>";
            echo "<li class='description inline'><span>" . $results['description'] . "</span></li>";
            echo "<li class='state inline'><span>" . $results['state'] . "</span></li>";
         echo "</ul>";
       }
}

function notes($wo_id)
{
    $notes_query="SELECT * FROM wo_notes WHERE wo_id= '$wo_id'";
    $run_query= mysqli_query($GLOBALS['link'], $notes_query);
    
	
    while($note_data = mysqli_fetch_array($run_query))
    {
        $get_user = "SELECT * FROM users WHERE user_id='{$note_data['user_id']}'";
        $run_user = mysqli_query($GLOBALS['link'], $get_user);
        $user = mysqli_fetch_array($run_user);
        
        echo "<div class='show_note'>";
            echo "<ul class='top_row'>";
                echo "<li>";
                echo "<span>Name: </span>";
                    echo $user['first'] . " " . $user['last'];
                echo " </li>";
                echo "   <li>";
		echo $note_data['date'];
                echo "</li>";
            echo "</ul>";
            
            echo "<ul class='bottom_row'>";
                echo "<li>";
                    echo $note_data['notes'];            
                echo "</li>";
            echo "</ul>";
        echo "</div>";
    }

}

function other_tickets()
{
	echo "this is working";
}

function workflow()
{
	echo "this might be working";
}

function assets()
{
	echo "this is another test of my keyboard skills";
}

function contact()
{
	echo "this takes t0oo much consentration";
}

function new_note($note, $wo_id, $user_id)
{
		$note = trim($note) ;
		if($note != "")
		{
		$query= "INSERT INTO wo_notes (notes, wo_id, user_id) VALUES ('$note', '$wo_id', '$user_id')";
		$run_query= mysqli_query($GLOBALS['link'], $query);
		}
}
/*----------THIS IS THE AUTOCOMPLETE CLASS FOR USERS THAT QUERIES THE SERVER FOR THE AUTOCOMPLETE ARRAY-------------*/
class users
	{
		public function find_users($users_name)
		{
			$data = array();
			
			$query = "SELECT * FROM users WHERE first LIKE '%" . $users_name . "%' OR last LIKE '%" . $users_name . "%' ";
			$run_query = mysqli_query($GLOBALS['link'], $query);
			while($result = mysqli_fetch_array($run_query, MYSQL_ASSOC))
			{
				$data[]= array("value"=> $result['first'] . " " . $result['last']);
				
			}
			
			return $data;
		}
	}
/*----------THIS IS THE AUTOCOMPLETE CLASS FOR CONFIGURATION ITEM THAT QUERIES THE SERVER FOR THE AUTOCOMPLETE ARRAY-------------*/
class auto_ci
	{
		public function find_config_item($config_item)
		{
			$data = array();
			
			$query = "SELECT * FROM configuration_item WHERE item LIKE '%" . $config_item . "%' ";
			$run_query = mysqli_query($GLOBALS['link'], $query);
			while($result = mysqli_fetch_array($run_query, MYSQL_ASSOC))
			{
				$data[]= array("value"=> $result['item']);
				
			}
			
			return $data;
		}
	}
class search_all  //this is for the autofind for the search bar
	{
		public function find_config_item($config_item)
		{
			$data = array();
			
			$query = "SELECT * FROM configuration_item WHERE item LIKE '%" . $config_item . "%' ";
			$run_query = mysqli_query($GLOBALS['link'], $query);
			while($result = mysqli_fetch_array($run_query, MYSQL_ASSOC))
			{
				$data[]= array("value"=> $result['item']);
				
			}
			
			return $data;
		}
		public function find_users($users_name)
		{
			$data = array();
			
			$query = "SELECT * FROM users WHERE first LIKE '%" . $users_name . "%' OR last LIKE '%" . $users_name . "%' ";
			$run_query = mysqli_query($GLOBALS['link'], $query);
			while($result = mysqli_fetch_array($run_query, MYSQL_ASSOC))
			{
				$data[]= array("value"=> $result['first'] . " " . $result['last']);
				
			}
			
			return $data;
		}
	}
class search_all_page //this is to be used in the search_view pages
	{
		public function find_config_item($config_item)
		{
			$data = array();
			
			$query = "SELECT * FROM configuration_item WHERE item LIKE '%" . $config_item . "%' ";
			$run_query = mysqli_query($GLOBALS['link'], $query);
			while($result = mysqli_fetch_array($run_query))
			{
				$data[]= array($result['item'], $result['description']);
			}
			
			return $data;
		}
		public function find_users($users_name)
		{
			$data = array();
			
			$query = "SELECT * FROM users WHERE first LIKE '%" . $users_name . "%' OR last LIKE '%" . $users_name . "%' ";
			$run_query = mysqli_query($GLOBALS['link'], $query);
			while($result = mysqli_fetch_array($run_query))
			{
				$data[]= array($result['first'], $result['last'], $result['username']);
			}
			
			return $data;
		}
		public function find_wo($wo_num)
		{
			$data = array();
			
			$query = "SELECT * FROM work_orders WHERE id LIKE '%" . $wo_num . "%' ";
			$run_query = mysqli_query($GLOBALS['link'], $query);
			while($result = mysqli_fetch_array($run_query))
			{	
				$user_query= "SELECT * FROM users WHERE user_id='{$result['user_id']}'";
				$user_info= mysqli_query($GLOBALS['link'], $user_query);	//this will get the user info from the user_id
				$user_data= mysqli_fetch_array($user_info);
				
				$data[]= array($result['id'], $result['description'], $user_data['first'], $user_data['last']);
			}
			
			return $data;
		}
	}
?>