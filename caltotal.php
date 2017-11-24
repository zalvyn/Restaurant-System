<?php
								
								session_start();
								$servername = "localhost";
								$username = "abc";
								$password = "abc";
								$dbname = "restaurant";
								
								
								
								

								
								
								$_SESSION["test"] = $_POST['orderno'];
								
								//$sql .= "; ";
								//$sql .= "INSERT INTO `order` (FoodID) VALUES ('$abc[1]')";
								
								//if (!$conn->multi_query($sql)) {
								//	echo "Multi query failed: (" . $conn->errno . ") " . $conn->error;
								//}

								//do {
								//	if ($res = $conn->store_result()) {
								//		var_dump($res->fetch_all(MYSQLI_ASSOC));
								//		$res->free();
								//	}
								//} while ($conn->more_results() && $conn->next_result());
								
									
									
								//}unset($abc);
								
								
								header("Location: order.php");
						?>