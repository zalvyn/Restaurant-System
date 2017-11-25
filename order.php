<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Order System</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Custom styles for this template -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <link href="user-man.css" rel="stylesheet" type="text/css" /> -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />



<script src="jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="order.css">
<!-- <script src="mindmup-editabletable.js"></script>
<script src="numeric-input-example.js"></script> -->
<!-- <script src="table-sort.js"></script> -->


</head>
<body>
<!-- Navigation -->
<?php
session_start();
?>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
<div class="icon-bar">
  <a class="active" href="index.html"><i class="fa fa-home"></i></a>
</div>

<ul class="title" >Order Review</p></ul>
<button type="button" class="btn btn-warning"><img src="icon/log-out.svg"> Logout </button>
</nav>
<!-- Page Content -->
<div class="container-fluid"><br>
<!-- Menu table -->

<form class="form-inline top-info" action="./searchorderid.php" METHOD="POST"> <!--    -->
  <input type="text" name="orderno" id="orderno" placeholder="Search Order Number">
  <!-- <div class="form-group"> -->
    <!-- <input type="orderID" class="form-control mr-sm-2 no_focus" type="text" placeholder="Order No." name="orderno" id="orderno" value="1"> -->
  <!-- </div> -->
	<input type="submit" value="abc" />
</form>

<form class="form-inline top-info" action="./searchtableid.php" METHOD="POST">
  <div class="form-group">
    <input type="text" class="form-control mr-sm-2 no_focus" id="tableno" name="tableno">
	<input type="submit" value="Submit" />
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

        if (isset($_SESSION["OrderID"])) {
          $sql = "SELECT orderid, quantity, masterorderid, foodid, price FROM `order` where masterorderid=".$_SESSION["OrderID"]." LIMIT 10 ;";
          echo "yes!";
		  
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						  // output data of each row
					 while($row = $result->fetch_assoc()) {
							//echo "{$row["price"]}";
						echo "<tr> <td>{$row["orderid"]} </td><td>{$row["quantity"]}</td><td>{$row["masterorderid"]}</td><td>{$row["foodid"]}</td><td>{$row["price"]}</td></tr>";
						}
					}
        } else if (isset($_SESSION["tableID"])){
			$sql = "SELECT price from `masterorder` where tableno='".$_SESSION["tableID"]."' LIMIT 10 ;";
		  echo "ha";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						  // output data of each row
					 while($row = $result->fetch_assoc()) {
						//echo "<tr> <td>{$row["orderid"]} </td><td>{$row["quantity"]}</td><td>{$row["masterorderid"]}</td><td>{$row["foodid"]}</td><td>{$row["price"]}</td></tr>";
						echo "{$row["price"]}";
						//echo "<tr> <td>{$row["orderid"]} </td><td>{$row["quantity"]}</td><td>{$row["masterorderid"]}</td><td>{$row["foodid"]}</td><td>{$row["price"]}</td></tr>";
						}
					}
		}else if (isset($_SESSION["test"])){
			$sql = 'SELECT sum(price) from `masterorder` where tableno='.$_SESSION["test"].'grouped by price';
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						  // output data of each row
					 while($row = $result->fetch_assoc()) {
						
							echo '<tr><td>'.$row["price"].'</td></tr>';
						}
					}
		}else {
          $sql = "SELECT orderid, quantity, masterorderid, foodid, price FROM `order` LIMIT 10";
          echo "no!";
        }
		


        
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>

<form class="form-inline" action="./calltotal.php" METHOD="POST">
  <div class="form-group">
    <h4>Total: </h4>
    <input type="total" class="form-control mr-sm-2 no_focus" type="text" name="total" id="total" readonly>
  </div>
</form>
<div class="form-group">
  <h4>Customer Paid: </h4>
  <input type="paid" class="form-control mr-sm-2 no_focus" type="text" id="paid">
</div>

<div class="form-group">
  <h4>Change: </h4>
  <input type="change" class="form-control mr-sm-2 no_focus" type="text" id="change" readonly>
</div>

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
    <!-- </div>
  </div> -->

<script>

$(document).ready(function () {
//   //var table = $('.table').DataTable();
		//calculate change
			 var change=0;
			 $("#paid").keypress(function(e) {
			   if(e.which == 13) {
				  change = $('#total').val() - $(this).val();
				 $("#change").val(change);
			   }
			   });
			//
 //calculate total
    $(document).on( "click","#total",function() {
     //e.preventDefault();
      var dat = $("#orderno").val();
	$.ajax({
        type     : "POST",
        // cache    : false,
        url      : "searchorderid.php",
        data     : {"orderno": dat},
        success  : function(data) {
          alert(data);
          //$("#total").empty();
          $("#total").val(data);
        }
      });
     });
    

  //Search Order Number
  $("#orderno").on( "keypress",function(e) {
    //e.preventDefault();
    var dat = $(this).val();
    if (e.keyCode == 13) {
      // e.preventDefault();
      $.ajax({
        type     : "POST",
        // cache    : false,
        url      : "searchorderid.php",
        data     : {"orderno": dat},
        success  : function(data) {
          //alert(data);
          $("#order").empty();
          $("#order").append("<tr>"+data+"</tr>");
        }
      });
    }
  });
});  
//
  
//
// });
</script>
</body>
</html>