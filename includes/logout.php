<?php
		session_start();
		
		if(isset($_COOKIE[session_name()])):
            setcookie(session_name(), '', time()-7000000, '/');
        endif;
		
		session_unset();
		session_destroy();
	
		header("location: ../index.php");
		exit();
               
?>