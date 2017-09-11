<?php 
    require_once("config.php");
    include_once("generate_dummy_data_for_db.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>CS362</title>
</head>

<body>
<h1>Welcome to our website</h1>

<h3>Here is our inventory</h3>

<table border="1">
    <tr>
        <td>Name</td>
        <td>Image</td>
        <td>Description</td>
        <td>Quantity</td>
        <td>Price</td>
    </tr>
    
    
    <?php 
        $sql = "SELECT * FROM `inventory`";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute query " . $conn->error . $sql;
        }
        
        $item = $result->fetch_assoc();
    
    while($item = $result->fetch_assoc()){
        
    
        echo "<tr>";
    
            echo "<td>";
            echo $item['name'];           
            echo "</td>";
            
            echo "<td>";
            echo $item['image'];           
            echo "</td>";
            
            echo "<td>";
            echo $item['description'];           
            echo "</td>";
            
            echo "<td>";
            echo $item['quantity'];           
            echo "</td>";
            
            echo "<td>";
            echo "$" . $item['price'];           
            echo "</td>";
    
        echo "</tr>";
    
    }
    ?>    
</table>

</body>
</html>
