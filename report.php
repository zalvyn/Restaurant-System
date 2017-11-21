<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, shrink-to-fit=no">
    <!-- <meta name="description" content="">
    <meta name="author" content=""> -->

    <title>Restaurant System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link href="report.css" rel="stylesheet" type="text/css" />

    <script src="lib/jquery-3.2.1.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script> -->
    <!-- <script src="lib/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!-- <script src="mindmup-editabletable.js"></script> -->
    <script src="report-input.js"></script>
    <script src="table-sort.js"></script>

</head>

<body>

<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand mr-auto" href="index.php">Home</a>

    <!-- <form class="form-inline">
      <input id="search" class="form-control mr-sm-2 no_focus" type="text" placeholder="Search by username" aria-label=" Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form> -->

    <button type="button" class="btn btn-warning"><img src="icon/log-out.svg"> Logout </button>
  </nav>
</header>
<h2>Daily Report</h2>
<!-- Time range show -->
<div class="time-range" id="time-range">
  <div class="dropdown">
   <button onclick="showDropdown(1)" class="dropbtn dropdown-toggle btn btn-primary" id="startYear">Year</button>
   <div id="startYearList" class="dropdown-content">
     <a>2017</a>
     <a>2016</a>
     <a>2015</a>
     <a>2014</a>
   </div>
  </div>
  <div class="dropdown">
   <button onclick="showDropdown(2)" class="dropbtn dropdown-toggle btn btn-primary" id="startMonth">Month</button>
   <div id="startMonthList" class="dropdown-content">
     <a>1</a><a>2</a><a>3</a>
     <a>4</a><a>5</a><a>6</a>
     <a>7</a><a>8</a><a>9</a>
     <a>10</a><a>11</a><a>12</a>
   </div>
  </div>
  <div class="dropdown">
   <button onclick="showDropdown(3)" class="dropbtn dropdown-toggle btn btn-primary" id="startDay">Day</button>
   <div id="startDayList" class="dropdown-content">
     <a>1</a><a>2</a><a>3</a><a>4</a><a>5</a>
     <a>6</a><a>7</a><a>8</a><a>9</a><a>10</a>
     <a>11</a><a>12</a><a>13</a><a>14</a><a>15</a>
     <a>16</a><a>17</a><a>18</a><a>19</a><a>20</a>
     <a>21</a><a>22</a><a>23</a><a>24</a><a>25</a>
     <a>26</a><a>27</a><a>28</a><a>29</a><a>30</a>
     <a>31</a>
   </div>
  </div>
  <span class="date-separator"> - </span>
  <div class="dropdown">
   <button onclick="showDropdown(4)" class="dropbtn dropdown-toggle btn btn-primary" id="endYear">Year</button>
   <div id="endYearList" class="dropdown-content">
     <a>2017</a>
     <a>2016</a>
     <a>2015</a>
     <a>2014</a>
   </div>
  </div>
  <div class="dropdown">
   <button onclick="showDropdown(5)" class="dropbtn dropdown-toggle btn btn-primary" id="endMonth">Month</button>
   <div id="endMonthList" class="dropdown-content">
     <a>1</a><a>2</a><a>3</a>
     <a>4</a><a>5</a><a>6</a>
     <a>7</a><a>8</a><a>9</a>
     <a>10</a><a>11</a><a>12</a>
   </div>
  </div>
  <div class="dropdown">
   <button onclick="showDropdown(6)" class="dropbtn dropdown-toggle btn btn-primary" id="endDay">Day</button>
   <div id="endDayList" class="dropdown-content">
     <a>1</a><a>2</a><a>3</a><a>4</a><a>5</a>
     <a>6</a><a>7</a><a>8</a><a>9</a><a>10</a>
     <a>11</a><a>12</a><a>13</a><a>14</a><a>15</a>
     <a>16</a><a>17</a><a>18</a><a>19</a><a>20</a>
     <a>21</a><a>22</a><a>23</a><a>24</a><a>25</a>
     <a>26</a><a>27</a><a>28</a><a>29</a><a>30</a>
     <a>31</a>
   </div>
  </div>
  <button type="button" class="btn btn-success" id="time-filter">Filter</button>
  <div class="btn-group" id="timeMode">
    <button type="button" class="btn btn-danger" id="dayMode">Day</button>
    <button type="button" class="btn btn-info" id="monthMode">Month</button>
    <button type="button" class="btn btn-warning" id="YearMode">Year</button>
  </div>
</div>

<div class="container">
  <div class="hero-unit">
     <table id="mainTable" class="table table-striped">
         <!-- <thead><tr>
             <th onclick="columnSort(0)" value="0">Report ID</th>
              <th onclick="columnSort(1)" value="0">Count</th>
              <th onclick="columnSort(2)" value="0">Income($)</th>
              <th onclick="columnSort(3)" value="0">Date</th>
              <th onclick="columnSort(4)" value="0">Staff ID</th>
        </tr></thead> -->
        <thead><tr>
             <th onclick="columnSort(0)" value="0">Count</th>
             <th onclick="columnSort(1)" value="0">Income($)</th>
             <th onclick="columnSort(2)" value="0">Month</th>
             <th onclick="columnSort(3)" value="0">Year</th>
       </tr></thead>
         <tbody>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// phpinfo();
// $limitRows = $_POST["limitRows"];
// $dateRange = $_POST["dateRange"];
$dateRange = $_GET["dr"];

class TableRows extends RecursiveIteratorIterator {
    // private static $index=0;
    function __construct($it){
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current(){
        // if (self::$index==0){
        //   $str = "<td class='no_focus'>";
        // } else {
        //   $str = "<td>";
        // }
        $str = "<td>";
        // self::$index++;
        return $str.parent::current()."</td>";
    }
    function beginChildren(){
        // self::$index=0;
        echo "<tr>";
    }
    function endChildren(){
        echo "</tr>\n";
    }
}

$servername="localhost";
$username = "user1";
$password = "123456";
$dbname = "Restaurant";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (is_null($dateRange)){
      $dateRange = array(2017,10,1,2018,5,3);
    }
    echo "<script type='text/javascript'>$('body').reportInit(".json_encode($dateRange).");</script>";
    $startDate = $dateRange[0]."-".$dateRange[1]."-".$dateRange[2];
    $endDate = $dateRange[3]."-".$dateRange[4]."-".$dateRange[5];
    // $sql = "select ReportID, Count, Income, Date, StaffID from report limit $limitRows";
    $sql = "select SUM(`Count`), SUM(Income), month(date),year(date) from report
            where date<='$endDate' and date>='$startDate'
            group by year(date),month(date);";

    // echo $sql;

    // dynamic filter by field
    // $tmp=[];
    // if (!is_null($fieldList) && !is_null($valueList)) {
    //   foreach ($fieldList as $index=>$field ){
    //     array_push($tmp, "$field=".$valueList[$index]);
    //   }
    //   $sql = $sql."where ".implode(", ", $tmp).";";
    // }

    $stmt = $conn->prepare($sql);
    $stmt->execute();   // $stmt = PDOStatement class

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); // return associated array
    // create html table
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll() )) as $k=>$v){
        echo $v;
    }

    // echo "success";

} catch (PDOException $e){
    echo $e->getMessage();
}
$conn = null;
// echo "</table>";

?>
</tbody>
<!-- <tfoot><tr><th><strong>TOTAL</strong></th><th></th><th></th><th></th></tr></thead> -->
</table>
</div>
</div>
<!-- <button type="button" id="updateBtn">Update</button><br> -->
<!-- <button type="button" id="addBtn">Add Row</button><br> -->
<!-- <button type="button" id="delBtn">Delete Row</button> -->

<datalist id="productName">
    <option value="Drink">Drink</option>
    <option value="Sides">Sides</option>
    <option value="Noodle">Noodle</option>
</datalist>


<footer class="footer">
    <div class="container">
        <div class="card-block" id="total-stat">
          <p id="bills"></p>
          <p id="income"></p>
        </div>
        <button type="button" class="btn btn-primary" id="viewOrderBtn">View order count</button>
    </div>
</footer>

<!-- <div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Warning</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this row?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="OK" data-dismiss="modal">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="passwordModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">New Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <label for="pwd">Please enter new password:</label>
        <input type="password" class="form-control no_focus" id="pwd">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="OK" data-dismiss="modal">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div> -->


</body>
</html>
