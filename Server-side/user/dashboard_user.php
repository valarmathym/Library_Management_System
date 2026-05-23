<?php
session_start();
require_once "../config/db.php";
include "../page_parts/header.php";

if(!isset($_SESSION['user_id']) || $_SESSION["role"] !== 'user'){
    header("location:./member-login-copy.php");
}
   $id = $_SESSION['user_id'];

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
    <title>User Dashboard</title>
</head>
<body>
<div class="admin-dash" >    
         <div><h1>Welcome, <?= $_SESSION['fname'] ?></h1></div>
        
         <div class="flex-container" id="flex-container">   
                <div class="flex-item-left" id="left">
                  <?php  
                      include "../page_parts/user-sidebar.php";  
                    ?>
                </div>
                <div class="flex-item-right" id="ad-content">
                        <h1>My account dashboard</h1>
                         <h3>Current Transaction </h3>
                    <ul id="user-home">
                       
                        <li>Total Borrowed Books :<?php echo countRecord("SELECT * FROM borrow_books WHERE user_id = '$id'", $conn);?></li>
                        <li>Total Returned Books :<?php echo countRecord("SELECT * FROM borrow_books WHERE user_id = '$id' AND status= 'Returned'", $conn);?></li>  
                    </ul>
                        
                </div>

        
         </div>
    </div>

  <?php
       include "../page_parts/footer.php";
   ?>   
</body>
</html>