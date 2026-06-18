<?php 

include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id=$id";
    if($conn->query($sql) === TRUE){
        header("Location: product.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>