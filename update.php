<?php
// update: valueList[[id1, ..],[id2, ..]]
// insertEmpty: idList, target_table
// delete: only delete 1 row at a time

$valueList = $_POST["valueList"];
$target_table = $_POST["target_table"];
$headerList = $_POST["headerList"];
$idList = $_POST["idList"];
$idName = $_POST["idName"];
$operation = $_POST["operation"];

$servername="localhost";
$username = "user1";
$password = "123456";
$dbname = "Restaurant";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($operation=="update"){
        // $sql = "update User set FName=?, LName=?, Age=?, Username=?, `Contact Number`=?, Position=? where id=?;";
        $columns = implode("=?, ", $headerList);
        $sql = "UPDATE $target_table SET ".$columns."=? WHERE $idName=?;";
        $stmt = $conn->prepare($sql);
        // echo $sql;
        foreach ($valueList as $index=>$value) {
            array_push($value, strval($idList[$index]));
            // print_r($value);
            $stmt->execute($value);
        }
        // echo "successfully updated " . $stmt->rowCount() . " rows";

    } else if ($operation=="insertEmpty"){
        $sql = "INSERT INTO `$target_table` (`$idName`) VALUES (NULL)";
        // echo $sql;
        $conn->exec($sql);

        // echo $valueList." success insert";

    } else if ($operation=="insert"){

      $columns = implode(", ", $headerList );

      foreach ($valueList as $row) {
        $values = "'".implode("', '", $row)."'";
        $sql = "INSERT INTO `$target_table` ($columns) VALUES ($values)";
        // echo $sql;
        $conn->exec($sql);
      }
    }

    else if ($operation == "delete"){
        $values = implode(", ", $valueList);
        $sql = "delete from `$target_table` where $idName in ($values)";
        $conn->exec($sql);

        // echo $valueList." deleted successfully";
    }

} catch (PDOException $e){
    echo $e->getMessage();
}
$conn = null;

?>

