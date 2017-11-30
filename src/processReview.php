<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_POST['review'])){
    header("Location: /");
}else{
    $review = trim($_POST['review']);
    $item_id = $_POST['item_id'];
}
$sql = "SELECT id FROM account WHERE username = '{$_SESSION['username']}' limit 1";
$user = $conn->query($sql);

if(!$user){
    echo "FAIL: " . $sql . $conn->error . "<br />";
}else{
    $user_id = $user->fetch_assoc();
    echo $user_id['id'];
    
    // Insert review with current user into the db
    $sql = "INSERT INTO review (user_id, product_id, comment) VALUES ({$user_id['id']}, {$item_id}, '{$review}')";
    $result = $conn->query($sql);
    if(!$result){
        echo "FAIL: " . $sql . $conn->error . "<br />";
    }
    header("Location: /");
}



?>