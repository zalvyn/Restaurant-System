<?php 
session_start();
$_SESSION["UserName"] = $_POST["inputName"];
$_SESSION["Password"] = $_POST["inputPassword"];

?>