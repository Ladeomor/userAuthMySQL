<?php
session_start();
require_once "../config.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db();
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $query = "INSERT INTO Students(full_names, country, email, gender, password) VALUES
        ('$fullnames', '$country', '$email', '$gender', '$password')";
    
        $result = mysqli_query($conn, $query);

        if(!$result){
            die('Invalid query: '.mysqli_error($conn));

        }else{
            echo 'Success';
        }

        


        
    }
   

   //check if user with this email already exist in the database
}


//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    $url ='http://localhost:8080/userAuthMySQL/dashboard.php';


    echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $query = "SELECT * FROM Students WHERE email = '$email' limit 1";
        $result = mysqli_query($conn, $query);

        if($result){
            if($result && mysqli_num_rows($result) > 0){

                $userdata = mysqli_fetch_assoc($result);

                if($userdata['password'] === $password && $userdata['email'] === $email){

                    $_SESSION['username'] = $userdata['email'];
                    //echo 'Success';
                    header("Location: $url");

                }

                
            }
        }else{
            die('Invalid: '.mysqli_error($conn));

        }


        


        
    }
    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
    //open connection to the database and check if username exist in the database
    $query = "SELECT password FROM Students WHERE email = '$email' ";
    $result = mysqli_query($conn, $query);

    if($result){
        if($result && mysqli_num_rows($result) > 0){
           // echo 'User  exists';
            mysqli_query($conn, "UPDATE Students SET password = '$password' WHERE email = '$email'");
        }else{
            echo 'User does not exist';
        }
    }

    //if it does, replace the password with $password given
}

function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();
     $query = "DELETE FROM Students WHERE id=$id";
     $result = mysqli_query($conn, $query);

     if($result){
         echo 'Record deleted successfully';
     }else{
        echo "Error deleting record: " . mysqli_error($conn);

     }

     //delete user with the given id from the database
 }
