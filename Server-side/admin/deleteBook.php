
<?php
require_once "../config/db.php";
include "../page_parts/header.php";
session_start();

if(!isset($_SESSION["user_id"])){
    header("location:./admin-login.php");
}

 $id =$_GET['id'];
 var_dump($id);	 
   

    // query to delete the the record
 $sql = "DELETE FROM books WHERE id = '$id'";

     // function to execute above query
        $result=mysqli_query($conn, $sql);       

      if ($result == TRUE)
	  {
       echo "Record deleted successfully";
       header("location:view_users.php");
      }
	  else{
        echo "Failed to delte the record";
      }
?>