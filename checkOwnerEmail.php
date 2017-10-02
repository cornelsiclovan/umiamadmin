<?php
	include 'includes/db.inc.php';
	
	if(isset($_POST['user']))
	{
		$user = mysqli_real_escape_string($link, $_POST['user']);
		$sql = "SELECT * FROM staff_user WHERE email='$user' and owner = '1'";
		$result = mysqli_query($link, $sql);
		if(mysqli_num_rows($result) == 0)
		{
			echo "<span id='inregistrat' style='color:red'>&nbsp;&#x2718; This email is not valid</span>";
		}
		else
		{
			echo "<span id='neinregistrat' style='color:green'>&nbsp;&#x2714; This email is valid</span>";
		}
	}