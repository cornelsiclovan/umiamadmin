<?php
	include 'includes/db.inc.php';
	
	if(isset($_POST['user']))
	{
		$user = mysqli_real_escape_string($link, $_POST['user']);
		$sql = "SELECT * FROM staff_user WHERE email='$user'";
		$result = mysqli_query($link, $sql);
		if(mysqli_num_rows($result)!=0)
		{
			echo "<span id='inregistrat' style='color:red'>&nbsp;&#x2718; This user is already registered</span>";
		}
		else
		{
			echo "<span id='neinregistrat' style='color:green'>&nbsp;&#x2714; This user is unregistered</span>";
		}
	}