<?php

require_once 'includes/access.inc.php';

if(!userIsLoggedIn())
{	
	if(isset($_GET['addowner']))
	{
		require_once 'includes/db.inc.php';
		
		$name 	  = mysqli_real_escape_string($link, $_POST['name_owner']);
		$email 	  = mysqli_real_escape_string($link, $_POST['email_owner']);
		$password = mysqli_real_escape_string($link, $_POST['password_owner']);
		$password_conf = mysqli_real_escape_string($link, $_POST['password_owner_conf']);
		
		
		if(!isset($_POST['email_owner']) or $_POST['email_owner'] == '' or !isset($_POST['password_owner']) or $_POST['password_owner']=='' 
															or !isset($_POST['name_owner']) or $_POST['name_owner']=='')
		{
			$GLOBALS['loginError'] = 'Please fill in all fields';
		}
		
		$sql = "SELECT * FROM staff_user WHERE email = '$email'";
		$result = mysqli_query($link, $sql);
		
		if(mysqli_num_rows($result)!=0)
		{
			echo '<script>
					document.getElementById("success").innerHTML = "";
					document.getElementById("failure").innerHTML = "&nbsp;&#x2718; This user is already registered!";
					window.alert(test)
				</script>';
			exit();
		}
		
		if($password_conf == $password)
		{
			$password = md5($password. 'ijdb');
			$sql = "INSERT INTO staff_user (name, email, password, owner) VALUES ('$name', '$email', '$password', '1')";
			if(mysqli_query($link, $sql))
				echo '<script>
					document.getElementById("failure").innerHTML = "";
					document.getElementById("success").innerHTML = "&nbsp;&#x2714; You have been registered as owner!";
				 </script>';
			
			
			
		}else{
			echo '<script>
						document.getElementById("success").innerHTML = "";
						document.getElementById("failure").innerHTML = "&nbsp;&#x2718; Password and password confirmation do not match";
					  </script>';
		
		}
		
		header('Location: .');
		exit();
	}
	
	if(isset($_GET['addstaff']))
	{
		require_once 'includes/db.inc.php';
		
		$name =  mysqli_real_escape_string($link, $_POST['name_staff']);
		$email = mysqli_real_escape_string($link, $_POST['email_staff']);
		$password = mysqli_real_escape_string($link, $_POST['password_staff']);
		$password_conf = mysqli_real_escape_string($link, $_POST['password_staff_conf']);
		$owner_code = mysqli_real_escape_string($link, $_POST['owner_code']);
		$email_owner = mysqli_real_escape_string($link, $_POST['email_owner']);
		if(!isset($_POST['email_staff']) or $_POST['email_staff'] == '' or !isset($_POST['password_staff']) or $_POST['password_staff']=='' 
															or !isset($_POST['name_staff']) or $_POST['name_staff']=='' 
															or !isset($_POST['admin_code']) or $_POST['admin_code']==''
															or !isset($_POST['email_owner']) or $_POST['email_owner']=='')
		{
			$GLOBALS['loginError'] = 'Please fill in all fields';
		}
		
		$sql = "SELECT * FROM staff_user WHERE email = '$email_owner' AND code = '$owner_code'";
		$result1 = mysqli_query($link, $sql);
		
		$sql = "SELECT * FROM staff_user WHERE email = '$email'";
		$result2 = mysqli_query($link, $sql);
		
		if(mysqli_num_rows($result2) != 0)
		{
			echo '<script>
						document.getElementById("success").innerHTML = "";
						document.getElementById("failure").innerHTML = "&nbsp;&#x2718; You are already registered";
						window.alert(test)
					</script>';
			exit();
		}
		
		if(mysqli_num_rows($result1) != 0 && $password_conf == $password)
		{
			$row 	  = mysqli_fetch_array($result1);
			$id_owner = $row['id'];
			$password = md5($password. 'ijdb');
			$sql = "INSERT INTO staff_user (name, email, password, staff, id_owner) VALUES ('$name', '$email', '$password', '1', '$id_owner')";
			if(mysqli_query($link, $sql))
				echo '<script>
						document.getElementById("failure").innerHTML = "";
						document.getElementById("success").innerHTML = "&nbsp;&#x2714; You have been registered as staff!";
					 </script>';
		}else{
				echo '<script>
						document.getElementById("success").innerHTML = "";
						document.getElementById("failure").innerHTML = "&nbsp;&#x2718; Code provided by owner is not valid";
					  </script>';
		}
		
		header('Location: .');
		exit();		
	}
	
	include 'login.html.php';
	
	if(isset($loginError)&& isset($_POST['isOwner']))
	{
		include 'error.html.php';
		exit();
	}

	if(isset($loginError)&& isset($_POST['isStaff']))
	{
		include 'error.html.php';
		exit();
	}

	
	if(isset($_GET['new_owner']))
	{
		include 'new_owner.html.php';
		exit();
	} 
	
	if(isset($_GET['new_staff']))
	{
		include 'new_staff.html.php';
		exit();
	}

	exit();
}
	


if(userIsOwner())
{
	if(isset($_GET['places']) || isset($_GET['add_place']))
	{
		include 'places.html.php';
		exit();
	}
	
	if(isset($_GET['add']))
	{
		include 'includes/db.inc.php';
		
		$country    = $_POST['country'];
		$name       = $_POST['name'];
		$city       = $_POST['city'];
		$street     = $_POST['street'];
		$number     = $_POST['number'];
		$zip_code   = $_POST['zip_code'];
		$region     = $_POST['region'];
		$email      = $_POST['email'];
		$num_tables = $_POST['num_tables'];
		
		$address = $street.', '.$city.', '.$country.', '.$zip_code;
		
		$owner_id = $_POST['id_owner'];
		
		$sql = "SELECT * FROM places WHERE name = '$name' AND city='$city' AND country = '$country' AND address='$address' AND email='$email' AND region = '$region'";
		$result = mysqli_query($link, $sql);
		
		if(mysqli_num_rows($result)!=0)
		{
			echo '<script>
				document.getElementById("success").innerHTML = "";
				document.getElementById("failure").innerHTML = "&nbsp;&#x2718; Proprietatea este deja inregistrata";
				</script>';
		}else
		{
			$sql = "INSERT INTO places (name, country, city, address, email, region, id_owner, table_number) VALUES ( '$name','$country', '$city', '$address', '$email', '$region', '$owner_id', '$num_tables')";
			$result = mysqli_query($link, $sql);
			echo '<script>
				document.getElementById("success").innerHTML = "&nbsp;&#x2718; Proprietatea a fost inregistrata";
				document.getElementById("failure").innerHTML = "";
				</script>';
		}
		
		include 'places.html.php';
		exit();
	}
	
	if((isset($_GET['manage']) || isset($_GET['add_tables']))&& isset($_GET['place_id'])){
		include 'includes/db.inc.php';
		
		$id = $_GET['place_id'];
	
		$sql = "SELECT * FROM places WHERE id = '$id'";
		$result = mysqli_query($link, $sql);
		
		$row = mysqli_fetch_array($result);
		$place_name = $row['name'];
		
		include 'manage_place.html.php';
		exit();
	}

	if(isset($_GET['add_staff_to_place'])){
		include 'includes/db.inc.php';
		$id 	  = $_GET['place_id'];
		$staff_id = $_GET['staff_id'];
		
		$sql = "SELECT * FROM places WHERE id = '$id'";
		$result = mysqli_query($link, $sql);
		
		$row = mysqli_fetch_array($result);
		$place_name = $row['name'];
		
		$sql = "UPDATE staff_user SET id_place = '$id' WHERE id = '$staff_id'";
		mysqli_query($link, $sql);
		
		include 'manage_place.html.php';
		exit();
	}
	
	if(isset($_GET['remove_staff_from_place'])){
		
		include 'includes/db.inc.php';
		$id 	  = $_GET['place_id'];
		$staff_id = $_GET['staff_id'];
		
		$sql = "SELECT * FROM places WHERE id = '$id'";
		$result = mysqli_query($link, $sql);
		
		$row = mysqli_fetch_array($result);
		$place_name = $row['name'];
		
		$sql = "UPDATE staff_user SET id_place = '0' WHERE id = '$staff_id'";
		mysqli_query($link, $sql);
		
		include 'manage_place.html.php';
		exit();
	}
	
	if(isset($_GET['add_tables_to_staff']) && isset($_POST['table_numbers']) && $_POST['table_numbers'] != ''){
		
		include 'includes/db.inc.php';
		
		$table_numbers = $_POST['table_numbers'];
		$id      	   = $_POST['place_id'];
		$staff_id      = $_POST['staff_id'];
		
		$sql4    	  = "SELECT * FROM places WHERE id = '$id'";
		$result4 	  = mysqli_query($link, $sql4);
		$row4    	  = mysqli_fetch_array($result4);
		$table_number = $row4['table_number']; 
		$place_name   = $row4['name'];
		
		$sql1 = "SELECT * FROM staff_user WHERE id_place = '$id'";
		$result1 = mysqli_query($link, $sql1);
		
		$all = array();
		
		while($row1 = mysqli_fetch_array($result1))
		{
			$tables = explode(',', $row1["tables"]);
			foreach($tables as $table){
				array_push($all, $table);
			}
		}
		
		$bool = true;
		$table_numbers_array = explode(',', $table_numbers);
		
		foreach($table_numbers_array as $t_n_a)
		{
			if(!in_array($t_n_a, $all))
				continue;
			else{
				$bool = false;
				break;
			}
		}
		
		if($bool)
		{
			$sql = "UPDATE staff_user SET tables = '$table_numbers' WHERE id = '$staff_id'";
			mysqli_query($link, $sql);
		}
		include 'manage_place.html.php';
		exit();
	}
	
	if(isset($_GET['rem_tables'])){
		
		include 'includes/db.inc.php';
		
		$id      	   = $_GET['place_id'];
		$staff_id      = $_GET['staff_id'];
		
		$sql4    	  = "SELECT * FROM places WHERE id = '$id'";
		$result4 	  = mysqli_query($link, $sql4);
		$row4    	  = mysqli_fetch_array($result4);
		$table_number = $row4['table_number']; 
		$place_name   = $row4['name'];
		
		$sql = "UPDATE staff_user SET tables = '' WHERE id = '$staff_id'";
		mysqli_query($link, $sql);
		
		include 'manage_place.html.php';
		exit();
	}
	
	if(isset($_GET['add_menu_to_place']))
	{
		include 'includes/db.inc.php';
		$id		  = $_GET['place_id'];
		$menu_id  = $_GET['menu_id'];
		
		$sql = "SELECT * FROM places WHERE id = '$id'";
		$result = mysqli_query($link, $sql);
		
		$row = mysqli_fetch_array($result);
		$place_name = $row['name'];
		
		$sql = "SELECT * FROM menu WHERE restaurant_id = '$id'";
		$result = mysqli_query($link, $sql);
		$num_rows = mysqli_num_rows($result);
		
		if($num_rows != 0)
		{
			
		}else{
			$sql = "UPDATE menu SET restaurant_id = '$id' WHERE id = '$menu_id'";
			mysqli_query($link, $sql);
		}
		
		include 'manage_place.html.php';
		exit();
	}
	
	if(isset($_GET['remove_menu_from_place']))
	{
		include 'includes/db.inc.php';
		$id 	 = $_GET['place_id'];
		$menu_id = $_GET['menu_id'];
		
		$sql = "SELECT * FROM places WHERE id = '$id'";
		$result = mysqli_query($link, $sql);
		
		$row = mysqli_fetch_array($result);
		$place_name = $row['name'];
		
		$sql = "UPDATE menu SET restaurant_id = '0' WHERE id = '$menu_id'";
		mysqli_query($link, $sql);
		
		include 'manage_place.html.php';
		exit();
	}
	
	if(isset($_GET['employees']))
	{
		include 'employees.html.php';
		exit();
	}
	
	if(isset($_GET['manage_employee'])){
		
		$employee_id = $_GET["employee_id"];
		include 'employee_to_table.html.php';
		
		exit();
	}
	
	if(isset($_GET['manage_menus']) || isset($_GET['add_menu_form']))
	{
		include 'manage_menus.html.php';
		exit();
	}
	
	if(isset($_GET['add_menu']))
	{
		include 'includes/db.inc.php';
		
		$name = $_POST['name'];
		$description = $_POST['description'];
		$id_owner = $_POST['id_owner'];
		
		$sql = "INSERT INTO menu (name, description, owner_id) VALUES ('$name', '$description', '$id_owner')";
		mysqli_query($link, $sql);
		
		include 'manage_menus.html.php';
		exit();
	}
	
	if(isset($_GET['manage_menu']) || isset($_GET['add_menu_item']))
	{
		include 'manage_menu.html.php';
		exit();
	}
	
	if(isset($_GET['add_item']))
	{
		include 'includes/db.inc.php';
		
		$name 		 = $_POST['name'];
		$description = $_POST['description'];
		$ingredients = $_POST['ingredients'];
		$price       = $_POST['price'];
		$category_id = $_POST['category'];
		$id_menu     = $_POST['id_menu'];
		
		$sql = "SELECT * FROM dish WHERE name = '$name'";
		$res = mysqli_query($link, $sql);
		
		if(mysqli_num_rows($res) != 0){}
		
		else{
			$sql = "INSERT INTO dish (name, description, ingredients, price, type_id, menu_id) VALUES ('$name', '$description', '$ingredients', '$price', '$category_id', '$id_menu')";
			mysqli_query($link, $sql);
		}
		include 'manage_menu.html.php';
		
		exit();
	}
	
	include 'owner.html.php';
	exit();
}

if(userIsStaff())
{
	if(isset($_GET['orders']) || isset($_GET['manage_order'])){
		
		
		include 'staff_order_details.html.php';
		exit();
	}
	
	include 'staff.html.php';
	exit();
}