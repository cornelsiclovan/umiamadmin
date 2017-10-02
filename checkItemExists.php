<?php
	include 'includes/db.inc.php';
	if(isset($_POST['item']))
	{
		$item = mysqli_real_escape_string($link, $_POST['item']);
		$sql = "SELECT * FROM dish WHERE name='$item'";
		$result = mysqli_query($link, $sql);
		if(mysqli_num_rows($result)!=0)
		{
			echo "<span id='inregistrat' style='color:red'>&nbsp;&#x2718; This menu item is already registered</span>";
		}
		else
		{
			echo "<span id='neinregistrat' style='color:green'>&nbsp;&#x2714; This menu item is unregistered</span>";
		}
	}