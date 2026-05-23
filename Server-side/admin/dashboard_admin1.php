<?php
session_start();
require_once "../config/db.php";
include "../page_parts/header.php";

if(!isset($_SESSION['user_id'])){
    header("location:./admin-login.php");
}

function countRecord($sql, $conn)
{
    $result= $conn->query($sql);
    return $result->num_rows;
}

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
        <link rel="stylesheet" type="text/css" href="..css/style.css">
        <script src="/js/jquery.form.js"></script> 
    <title>Admin Dashboard</title>
</head>
<body>

   <div class="admin-dash" >    
          <h1> Welcome to Admin Dashboard!</h1>
         
         <div class="flex-container">  
                <div class="flex-item-left">
                  <?php  
                      include "../page_parts/admin-sidebar.php";  
                   ?>
                </div>
                <div class="flex-item-right" id="ad-content">
                    <ul id="ad-home">
                        <li>Total Registered Users :<?php echo countRecord("SELECT * FROM users", $conn);?></li>
                        <li>Total Books :<?php echo countRecord("SELECT * FROM books", $conn);?></li>
                        <li>Total Issued Books :<?php echo countRecord("SELECT * FROM borrow_books", $conn);?></li>
                        <li>Total Returned Books :<?php echo countRecord("SELECT * FROM borrow_books WHERE status= 'Returned'", $conn);?></li>  
                    </ul>
                        
                </div>

        
         </div>
    </div>

  <?php
       include "../page_parts/footer.php";
   ?>   
</body>
</html>