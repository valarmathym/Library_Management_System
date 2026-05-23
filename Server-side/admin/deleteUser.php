<?php
require "../config/db.php";

 $id =$_GET['id'];
 var_dump($id);	 
   

    // query to delete the the record
 $sql = "DELETE FROM users WHERE id = '$id'";

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