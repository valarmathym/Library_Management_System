<?php
require_once "../config/db.php";
include "../page_parts/header.php";

session_start();

if(!isset($_SESSION["user_id"])){
    header("location:./member-login-copy.php");
}
 $id = $_SESSION['user_id'];
   ?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <link rel="stylesheet" href="../css/style.css">

     <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="/js/jquery.form.js"></script> 
    <title>User Dashboard</title>
</head>
<body>
      <div class="admin-dash" >    
         <div><h1>Welcome, <?= $_SESSION['fname'] ?></h1></div> 
        
    <div class="flex-container">
        <h1> View Personal Details</h1>  
        <div class="flex-item-left">
            <?php include "../page_parts/user-sidebar.php"; ?>
        </div>
                <div class="flex-item-right" id="ad-content">
                     
                    <?php
                        $sql = "SELECT * FROM users where  id = '$id'"; 
                        $result =$conn->query($sql);
                        if($result->num_rows>0)
                        {
                            echo "<table>
                            <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                    
                            </tr>";
                             
                            $i=0;
                            while($row = $result->fetch_assoc())
                            {
                                $i++;
                                echo "<tr>";
                                echo "<td>{$row["id"]}</td>";
                                echo "<td>{$row["fname"]}</td>";
                                echo "<td>{$row["lname"]}</td>";
                                echo "<td>{$row["email"]}</td>";
                                echo "<td>{$row["role"]}</td>";
                                echo "<td><a href='editUser.php?id=" . $row['id'] . "'>EDIT</a></td>";
                                echo "</tr>";
                            } 
                                echo "</table>";
                            
                        }
                        else{
                            echo "<p class='error'>No User Records Found! </p>";
                        }
                   ?>  
                </div>
        
         </div>
    </div>

  <?php
       include "../page_parts/footer.php";
   ?>   
</body>
</html>