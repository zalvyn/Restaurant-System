<html>
<body>    
    <?php
    
    
    if (empty($_GET['phone'])){
        echo "pls check";
    } else{
        echo "<br><p>tel: ".$_GET['tel']."</p>";
        echo "<br><p>age: ".$_GET['age']."</p>";
    }
    echo "<p>hi</p>";
    
    ?>
</body>
</html>

