<?php
// update: valueList[[id1, ..],[id2, ..]]
// insertEmpty: idField, target_table
// delete: only delete 1 row at a time

$valueList = $_POST["valueList"];
$target_table = $_POST["target_table"];
$headerList = $_POST["headerList"];
$idField = $_POST["idField"];
$operation = $_POST["operation"];

$servername="localhost";
$username = "user1";
$password = "123456";
$dbname = "myDBPDO";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($operation=="update"){
        // $sql = "update User set FName=?, LName=?, Age=?, Username=?, `Contact Number`=?, Position=? where id=?;";
        $columns = implode("=?, ", $headerList);
        $sql = "UPDATE $target_table SET $columns=? WHERE $idField=?;";
        $stmt = $conn->prepare($sql);
        
        echo $valueList;
        foreach ($valueList as $value) {
            $tmp = array_map('mysql_real_escape_string', $value);
            $id = array_shift($tmp);
            array_push($tmp, $id);
            // print_r($tmp);
            $stmt->execute($tmp);
        }
        echo "successfully updated " . $stmt->rowCount() . " rows";

    } else if ($operation=="insertEmpty"){
        // $stmt = $conn->prepare("insert into MyGuests (firstname, lastname, email)
        //     values (:firstname, :lastname, :email)");
        // $stmt->bindParam(':firstname', $fn);
        // $stmt->bindParam(':lastname', $ln);
        // $stmt->bindParam(':email', $email);

        // foreach ($valueList as $value){
        //     $fn = $value[0];
        //     $ln = $value[1];
        //     $email = $value[2];
        //     $stmt->execute();
        // }
        $sql = "INSERT INTO `$target_table` (`$idField`) VALUES (NULL)";
        $conn->exec($sql);

        echo $valueList." success insert";

    } else if ($operation=="insert"){
      
      $columns = implode(", ", $headerList );
      
      foreach ($valueList as $row) {
        $escaped_values = array_map('mysql_real_escape_string', $row );
        $values = implode(", ", $escaped_values);
        $sql = "INSERT INTO `$target_table` ($columns) VALUES ($values)";
        $conn->exec($sql);
      }
    }
    
    else if ($operation == "delete"){
        $values = implode(", ", $valueList);
        $sql = "delete from `$target_table` where $idField in ($values)";
        $conn->exec($sql);

        echo $valueList." deleted successfully";
    }

} catch (PDOException $e){
    echo $e->getMessage();
}
$conn = null;

?>

