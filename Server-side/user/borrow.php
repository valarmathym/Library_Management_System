<?php
session_start();
require_once "../config/db.php";
include "../page_parts/header.php";


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("location:./member-login-copy.php");
    //echo "You are not logged in. <a href='./member-login-copy.php'>User Login</a>";
    exit;
}

// Check role
if ($_SESSION["role"] !== 'user') {
    header("Location:./admin/dashboard_admin.php");
    exit;
}
// User is logged in and has role 'user'
    $user_id = $_SESSION['user_id'];
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowed books by User</title>
</head>
<body>
    <?php
     // Validate GET parameter
                if (isset($_GET['id'])) {
                   $book_id = intval($_GET['id']); // safely convert to integer

                    //insert borrow record
                    $sql ="INSERT INTO borrow_books(user_id, book_id, borrow_date, due_date, status) values('$user_id', '$book_id', CURDATE(), CURDATE() + INTERVAL 21 DAY, 'On Loan')";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        //update book quantity
                        $sql2 = "UPDATE books SET availability = availability-1 where id ='$book_id' ";
                        $result2 = mysqli_query($conn, $sql2);

                        echo "Your request has been sent to the admin!<a href='./dashboard_user.php'>Go back to User dashboard</a>";
                    }
                    else{
                        echo "error!: {$conn->error}";
                    }
                }

                  //code for Users borrow a book
                    $sql = "SELECT * FROM borrow_books where user_id = '$user_id' AND book_id = '$book_id'";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows == 1) {
                        echo "<table>
                            <tr>
                                <th>Book ID</th>
                                <th>User ID</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th>Return Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>";
                           
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['book_id']}</td>
                                    <td>{$row['user_id']}</td>
                                    <td>{$row['borrow_date']}</td>
                                    <td>{$row['due_date']}</td>
                                    <td>{$row['return_date']}</td>
                                    <td>{$row['status']}</td>
                                    <td>
                                        <a href='../edit_return_book.php?id={$row["id"]}' onclick='return confirm(\"Mark this book as On Loan?\")'>Return</a>
                                    </td>
                                </tr>";
                           }
                          echo "</table>";
                      } else {
                        echo "<p>No borrow record found.</p>";
                    }

           ?>   
           
  <?php
       include "../page_parts/footer.php";
   ?>  
    
</body>
</html>
