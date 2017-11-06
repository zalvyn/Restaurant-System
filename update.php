<?php
// phpinfo();


$valueList = $_POST["valueList"];
// $headerList = $_POST["headerList"];
$operation = $_POST["operation"];

$servername="localhost";
$username = "user1";
$password = "123456";
$dbname = "myDBPDO";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($operation=="update"){
        $sql = "update MyGuests set firstname=?, lastname=?, email=? where id=?;";
        $stmt = $conn->prepare($sql);
        echo $valueList;
        foreach ($valueList as $value) {
            $tmp = $value;
            $id = array_shift($tmp);
            array_push($tmp, $id);
            // print_r($tmp);
            $stmt->execute($tmp);
        }
        echo "successfully updated " . $stmt->rowCount() . " rows";
        
    } else if ($operation=="insert"){
        $stmt = $conn->prepare("insert into MyGuests (firstname, lastname, email)
            values (:firstname, :lastname, :email)");
        // $stmt->bindParam(':id', $id);
        $stmt->bindParam(':firstname', $fn);
        $stmt->bindParam(':lastname', $ln);
        $stmt->bindParam(':email', $email);
        
        foreach ($valueList as $value){
            // $id =  $value[0];
            $fn = $value[0];
            $ln = $value[1];
            $email = $value[2];
            $stmt->execute();
        }

        echo $valueList." success insert";
        
    } else if ($operation == "delete"){
        $sql = "delete from MyGuests where id=?";
        $stmt = $conn->prepare($sql);
        
        // foreach ($valueList as $value){
            $stmt->execute($valueList);
        // }
        echo $valueList." deleted successfully";
    }

} catch (PDOException $e){
    echo $e->getMessage();
}
$conn = null;

?>

