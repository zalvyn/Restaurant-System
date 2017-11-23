<?php
								
								
								$servername = "localhost";
								$username = "abc";
								$password = "abc";
								$dbname = "restaurant";
								
								
								
								// Create connection
								$conn = new mysqli($servername,$username,$password,$dbname);
								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								} 
								$abc =$_POST['total'];
								
								
								print_r ($abc."<br>");
								$sql = 'Select sum(price) 
								from `masterorder` where masterorderid = ($abc)
								grouped by "price"; ';
								$result = $conn->query($sql);
								
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
											echo '$row["price"]';
									}
								} else {
									echo "0 results";
								}
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
								
								
								$conn->close();
						?>