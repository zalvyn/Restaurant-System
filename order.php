<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Order System</title>

    <!-- Bootstrap core CSS -->
    
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="user-man.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	
    <script src="lib/jquery-3.2.1.min.js"></script>
	<script src="jquery.dataTables.min.js"></script>
    <script src="mindmup-editabletable.js"></script>
    <script src="numeric-input-example.js"></script>
    <script src="table-sort.js"></script>
    
	<style>
      
					
		.btn-primary {
					 
					 
					  width:200px;
					  color: #333;
					  background-color: #d3d3d3;
					  border-color: #adadad;
					  border-radius: 30px;
					  
		}
		
		.icon-bar {
   				 width: 100px;
   				 background-color: #555;
		}
		.icon-bar a {
				display: block;
				text-align: center;
				transition: all 0.3s ease;
				color: white;
				font-size: 40px;
		}
		
		.title {
				padding-left:20px;
				color:white;
				font-size:40px;
				margin: 0 auto;
				font-weight: 600;
				
		}
		
		.container-fluid{
				padding-top:3%;
				padding-left:6%;
		}
		
		.table{
				 width: 100%;
				
				font-size:25px;
		}
		
		
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
}
    </style>
  </head>
  <body>
    <!-- Navigation -->
   
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<div class="icon-bar">
     			<a class="active" href="index.html"><i class="fa fa-home"></i></a> 
   			 </div>
				
			 
				<ul class="title" >Order Review</p></ul>
			
			
    <button type="button" class="btn btn-warning"><img src="icon/log-out.svg"> Logout </button>
  </nav>
    <!-- Page Content -->
    <div class="container-fluid">
		<!-- Menu table -->	
		
		<br>
		
		<form class="form-inline"  action="./searchorderid.php" METHOD="POST">
		<div class="form-group">
			<input type="orderID" class="form-control mr-sm-2 no_focus" type="text" placeholder="Order No." name="orderno" id="orderno">
		</div>
		</form>
		<form class="form-inline" action="./searchtableid.php" METHOD="POST">
		<div class="form-group">
			<input type="tableID" class="form-control mr-sm-2 no_focus" type="text" placeholder="Table No." name="tableno" id="tableno">
		</div>
		</form>
		
		
		<br>
		<div class="row  justify-content-md-center">
			<div class="col-sm-7">
			<table class="table table-dark table-hover">
				  <thead>
					<tr>
					  <th>OrderID</th>
					  <th>Quantity</th>
					  <th>MasterOrder_ID</th>
					  <th>FoodID</th>
					  <th>Price</th>
					  <!--<th>Price ($)</th>-->
					 
					</tr>
				  </thead>
				  <tbody id="order">
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

								$sql = "SELECT orderid, quantity, masterorderid, foodid, price FROM `order` LIMIT 10";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
											echo "<tr> <td>{$row["orderid"]} </td><td>{$row["quantity"]}</td><td>{$row["masterorderid"]}</td><td>{$row["foodid"]}</td><td>{$row["price"]}</td></tr>";
									}
								} else {
									echo "0 results";
								}
								$conn->close();
						?>
				  </tbody>
			</table>
			</div>
		</div>
		
		<form class="form-inline">
			<div class="form-group">
				 <h4>Total: </h4>
			 
				<input type="total" class="form-control mr-sm-2 no_focus" type="text" id="total" readonly></div>
			
			<div class="form-group">
				 <h4>Customer Paid: </h4>
			 
				<input type="paid" class="form-control mr-sm-2 no_focus" type="text" id="paid"></div>
				
			<div class="form-group">
				 <h4>Change: </h4>
			 
				<input type="change" class="form-control mr-sm-2 no_focus" type="text" id="change" readonly></div>
				
			
			
		</form>
		
		<div class="row">
			<div class="col-sm-3">
				<br>
				<a class="btn btn-primary" href="menu.php"><h4 class="my-3">New Order</h4></a>
				<br>
				<br>
			</div>
			<div class="col-sm-3">
				<br>
				<a class="btn btn-primary" href="#"><h4 class="my-3">Confirm Order</h4></a>
			</div>
			<div class="col-sm-3">
				<br>
				<a class="btn btn-primary" href="#"><h4 class="my-3">Complete</h4></a>
			</div>
			<div class="col-sm-3">
				<br>
				<a class="btn btn-primary" href="#"><h4 class="my-3">Confirm Order</h4></a>
			</div>
		</div>
		
			
		
	</div>
	
	
    </div>
	
	<script>
			//calculate change
			$(document).ready(function () {
			//var table = $('.table').DataTable();
				var change=0;
				$("#paid").keypress(function(e) {
					if(e.which == 13) {
						change = $('#total').val() - $(this).val();
						$("#change").val(change);
					}			
				});
				
			//Search Order Number
				
				 $(document).on( "keypress","#orderno",function(e) {
					//e.preventDefault();
					if (e.keyCode == 13) {
						
						e.preventDefault();
						$.ajax({
						type     : "POST",
						cache    : false,
						url      : "searchorderID.php",
						data     : $(this).serialize(),
						success  : function(data) {
							$("#order").empty();
							$("#order").append("<tr>"+data+"</tr>");
						}
									

				
					});
					
					}
					
				});
				
				
				//Search Table Number
				
				 $(document).on( "keypress","#tableno",function(e) {
					//e.preventDefault();
					if (e.keyCode == 13) {
						
						e.preventDefault();
						$.ajax({
						type     : "POST",
						cache    : false,
						url      : "searchtableid.php",
						data     : $(this).serialize(),
						success  : function(data) {
							alert(data);
							$("#order").empty();
							$("#order").append("<tr>"+data+"</tr>");
						}
									

				
					});
					
					}
					
				});
				
				
            });
	</script>
  </body>
</html>