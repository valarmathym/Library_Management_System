<?php
require_once "../config/db.php";
include "../page_parts/header.php";
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'user'){
    header("location:./member-login-copy.php");
    exit;
}
 $id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['return_id'])) {
        $borrow_id = (int)$_POST['return_id']; // Make sure 'return_id' matches the name in your form

        // Get book_id tied to this borrow record
        $query = "SELECT book_id, user_id FROM borrow_books WHERE id = '$borrow_id' ";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $book_id = (int)$row['book_id'];

            // Update return date and book availability
            mysqli_query($conn, "UPDATE borrow_books SET return_date = NOW(), status = 'returned'  WHERE id = $borrow_id");
            mysqli_query($conn, "UPDATE books SET availability = availability + 1 WHERE id = $book_id");

            $msg = "Book returned successfully.";
        } else {
            $msg = "Invalid borrow ID.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <link rel="stylesheet" href="../css/style.css">

     <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="/js/jquery.form.js"></script>    
<title>Borrowed Books</title></head>
<body>
<h2>Borrowed Books</h2>

<?php
// Fetch borrowed books list
$sql2 = "
    SELECT bb.id, u.fname, b.title, bb.borrow_date, bb.due_date, bb.return_date, bb.book_id
    FROM borrow_books bb
    JOIN users u ON bb.user_id = u.id
    JOIN books b ON bb.book_id = b.id
    ORDER BY bb.due_date ASC";

$result2 = mysqli_query($conn, $sql2);

if ($result2 && mysqli_num_rows($result2) == 1) {
    echo "<table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Book</th>
            <th>Borrowed On</th>
            <th>Due Date</th>
            <th>Return Date</th>
            <th>Action</th>
        </tr>";

    while ($row = mysqli_fetch_assoc($result2)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['fname']}</td>";
        echo "<td>{$row['title']}</td>";
        echo "<td>{$row['borrow_date']}</td>";
        echo "<td>{$row['due_date']}</td>";
        echo "<td>{$row['return_date']}</td>";
        echo "<td>
            <form method='POST' style='display:inline;'>
                <input type='hidden' name='return_id' value='{$row['id']}'>
                <button type='submit'>RETURN</button>
            </form> |
            
        </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No borrowed books found.</p>";
}
?>

<?php
       include "../page_parts/footer.php";
   ?>   
</body>
</html>
