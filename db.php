<?php
$dbhost = 'localhost';
$user = 'root';
$pass = '';
$database = 'dashboard2';

try {
    //connection to mysql
    $conn = new mysqli($dbhost, $user, $pass);
    if (!$conn) {
        die('Fail ' . mysqli_connect_error());
    }
    //create database if not have database
    $create_db = "CREATE DATABASE IF NOT EXISTS $database";
    if (mysqli_query($conn, $create_db)) {
        $message = "successfully";
    } else {
        $message = "cteate database fail";
    }
    //use database
    mysqli_select_db($conn, $database);
    //create table command
 
$create_table = "CREATE TABLE if not exists products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

)";    
if ($conn->query($create_table) === TRUE) {
   
} else {
    echo "Error creating table: " . $conn->error;
}





} catch (\Throwable $th) {
    die('fail ' . $th);
}
// echo $message;
