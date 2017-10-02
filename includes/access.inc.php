<?php

	function userIsLoggedIn()
	{
		$isOwner = 0;
		$isStaff = 0;
		
		if(isset($_POST['action']) and $_POST['action'] == 'login')
		{
			if(!isset($_POST['email']) or $_POST['email'] == '' or !isset($_POST['password']) or $_POST['password']=='')
			{
				$GLOBALS['loginError'] = 'Please fill in both fields';
				return FALSE;
			}	
			
			if(isset($_POST['isOwner']))
				$isOwner = $_POST['isOwner'];
			
			if(isset($_POST['isStaff']))
				$isStaff = $_POST['isStaff'];
			
			
			
			
			$password = md5($_POST['password'] . 'ijdb');
			
			if(databaseContainsAuthor($_POST['email'], $password, $isOwner, $isStaff))
			{
				session_start();
				$_SESSION['isOwner'] = $isOwner;
				$_SESSION['isStaff'] = $isStaff;
				$_SESSION['loggedIn'] = TRUE;
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['password'] = $password;
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (1 * 60);
				header('Location: index.php'); //nedeed for successful logout
				return TRUE;
			}else
			{
				session_start();
				unset($_SESSION['isOwner']);
				unset($_SESSION['isStaff']);
				unset($_SESSION['loggedIn']);
				unset($_SESSION['email']);
				unset($_SESSION['password']);
				$GLOBALS['loginError'] =
						'The specified email address or password was incorrect.';
				return FALSE;
			}
		}
		
		if (isset($_POST['action']) and $_POST['action'] == 'logout')
			{
				session_start();  
				unset($_SESSION['isOwner']);
				unset($_SESSION['isStaff']);
				unset($_SESSION['loggedIn']);
				unset($_SESSION['email']);
				unset($_SESSION['password']);
				header('Location: ' . $_POST['goto']);
				exit();
			}
		
		session_start();
		if(isset($_SESSION['loggedIn']))
		{
			return databaseContainsAuthor($_SESSION['email'], $_SESSION['password'], $_SESSION['isOwner'], $_SESSION['isStaff']);
		}
	}
	
	function databaseContainsAuthor($email, $password, $isOwner, $isStaff)
	{
		include 'db.inc.php';
		
		$email = mysqli_real_escape_string($link, $email);
		$password = mysqli_real_escape_string($link, $password);
		
		if($isOwner == 1){
			$sql = "SELECT * FROM staff_user
				WHERE email = '$email' AND password = '$password' AND owner = '1'";	
		}
		
		//echo $email.', '.$isOwner.', '. $password;
		
		if($isStaff == 1)
		{	
			$sql = "SELECT * FROM staff_user
				WHERE email = '$email' AND password = '$password' AND staff = '1'";
		}
		
		$result = mysqli_query($link, $sql);
		
		//echo "<br/>".mysqli_num_rows($result);
		
		if (mysqli_num_rows($result)>0)
		{
			return TRUE;               
		}
		else
		{
			return FALSE;
		}
		
		
	}
	
	
	function userIsOwner()
	{
		include 'db.inc.php';
		
		$email = mysqli_real_escape_string($link, $_SESSION['email']);
		$password = mysqli_real_escape_string($link, $_SESSION['password']);
		
		$sql = "SELECT COUNT(*) FROM staff_user WHERE email='$email' and owner = '1'";
				
		$result = mysqli_query($link, $sql);
		if (!$result)
		{
			$error = 'Error searching for administrator.';
			include 'error.html.php';
			exit();
		}
		$row = mysqli_fetch_array($result);
		if ($row[0] > 0 && $_SESSION['isOwner']==TRUE)
		{
			return TRUE;               
		}
		return FALSE;
	}
	
	function userIsStaff()
	{
		include 'db.inc.php';
		
		$email = mysqli_real_escape_string($link, $_SESSION['email']);
		$password = mysqli_real_escape_string($link, $_SESSION['password']);
		
		$sql = "SELECT COUNT(*) FROM staff_user WHERE email='$email' AND staff = '1'";
			
		$result = mysqli_query($link, $sql);
		if (!$result)
		{
			$error = 'Error searching for locatar.';
			include 'error.html.php';
			exit();
		}
		$row = mysqli_fetch_array($result);
		if ($row[0] > 0 && $_SESSION['isStaff']==1)
		{
			return TRUE;               
		}
		return FALSE;
	}