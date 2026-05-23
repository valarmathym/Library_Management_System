
<?php
require_once "../config/db.php";
include "../page_parts/header.php";
session_start();


if(!isset($_SESSION["user_id"])){
    header("location:./admin-login.php");
}


    if (isset($_POST['submit'])) {
        $id       = $_POST['id'];
        echo "$id"; 
        $lname    = $_POST['lname'];
        $email    = $_POST['email'];

            $stmt = $conn->prepare("UPDATE users SET lname = ?, email = ?  WHERE id = ?");
            $stmt->bind_param("ssi", $lname, $email, $id);

       if ($stmt->execute()) {
        // print_r($stmt);
         //echo "$id";
           echo "User updated successfully!";
    
         // header("Location: view_users.php");
          } else {
           echo "Error updating user: " . $stmt->error;
         }   
    }

?>

