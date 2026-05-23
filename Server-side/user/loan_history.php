<?php
require_once "../config/db.php";
include "../page_parts/header.php";
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'user'){
    header("location:./member-login-copy.php");
   
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
        
        <script src="/js/jquery.form.js"></script> 
    <title>Borrowed Books</title>
</head>
<body>
<div class="admin-dash">
    <div><strong><h1>Welcome, <?= $_SESSION['fname'] ?></h1></strong></div>

    <div class="flex-container">  
        <div class="flex-item-left">
            <?php include "../page_parts/user-sidebar.php"; ?>
        </div>

        <div class="flex-item-right" id="ad-content">
            <h1><strong>My account dashboard</strong></h1><br>
           
         <h3><strong>Loan History</strong> </h3>
     <?php

            $sql = "SELECT * FROM borrow_books where user_id = '{$_SESSION["user_id"]}' "; 
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Book ID</th>
                        <th>User ID</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['book_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['borrow_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['due_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['return_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td><a href='edit_return_books.php?id=" . ($row['id']) . "'>RETURN</a></td>"; 
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p class='error'>No User Records Found!</p>";
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