<?php
session_start();

$servername = "localhost";
$username = "abc";
$password = "abc";
$dbname = "restaurant";

// $SESSION_["OrderID"] = "";
// echo "orderno:".$SESSION["OrderID"];
$_SESSION["tableID"] = $_POST['tableno'];
// echo "orderno:".$_POST['orderno'];

// $conn = new mysqli($servername,$username,$password,$dbname);
// if ($conn->connect_error) {
// 	die("Connection failed: " . $conn->connect_error);
// }
// 
// $orderNo = $_POST['orderno'];
// print_r ($orderNo."<br>");
// 
// $sql = "Select * from `order` where masterorderid = ($orderNo); ";
// $result = $conn->query($sql);
// 
// if ($result->num_rows > 0) {
// 	// output data of each row
// 	while($row = $result->fetch_assoc()) {
// 		echo "<tr><td>{$row['OrderID']}</td><td>{$row['Quantity']}</td><td>{$row['MasterOrderID']}</td><td>{$row['FoodID']}</td><td>{$row['Price']}</td></tr>";
// 	}
// } else {
// 	echo "0 results";
// }



//$sql .= "; ";
//$sql .= "INSERT INTO `order` (FoodID) VALUES ('$orderNo[1]')";

//if (!$conn->multi_query($sql)) {
//	echo "Multi query failed: (" . $conn->errno . ") " . $conn->error;
//}

//do {
//	if ($res = $conn->store_result()) {
//		var_dump($res->fetch_all(MYSQLI_ASSOC));
//		$res->free();
//	}
//} while ($conn->more_results() && $conn->next_result());
//}unset($orderNo);

// $conn->close();

// return to original

header("Location: order.php");


?>