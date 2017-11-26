<?php

session_start();
$_SESSION["tableID"] = $_POST['orderno1'];
header("Location: order.php");

?>