<?php
include 'config.php';

$sql = "CREATE TABLE Students (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    full_names VARCHAR(120) NOT NULL,
    country VARCHAR(32) NOT NULL,
    email VARCHAR(60),
    gender VARCHAR(10),
    password VARCHAR(256)

)";
if($conn){
    if(mysqli_query($conn, $sql)){
        echo "Table Created Succeessfully";
    }else{
        echo "Error Creating table: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>