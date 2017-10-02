<?php
 require_once 'includes/db.inc.php';
 $dish_id = $_GET["dish_id"];
 $check_value = $_GET["check_value"];
 $order_id    = $_GET["order_id"];
 
 echo "<p>".$check_pr_id.$check_value."</p>";
 if($check_value=='on/'){
	 $switch = 0;
 }else{
	 $switch = 1;
 }
 echo "<p>".$switch."</p>";
 $sql = "UPDATE customer_dish SET taken = '$switch' WHERE id_dish = '$dish_id' AND order_id = '$order_id'";
 mysqli_query($link, $sql);
?>