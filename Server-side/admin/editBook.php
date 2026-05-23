<?php
require_once "../config/db.php";
include "../page_parts/header.php";

session_start();

if(!isset($_SESSION["user_id"])){
    header("location:./admin-login.php");
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
        
        <script src="/js/jquery.form.js"></script> 
    <title>Edit Book</title>
</head>
<body>

<div class="wrapper">
    <div class="admin-dash">
          <h1> Edit Book  Details</h1><br>
          
          <div class="flex-container">  
                <div class="flex-item-left">
                    <?php  
                        include "../page_parts/admin-sidebar.php";  
                    ?>
                </div>
               
                <div class="flex-item-right" id="ad-content">
            <?php
            // Fetch book details     
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    // Use prepare() for safety and bind parameters 
                    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();

                    $result = $stmt->get_result();
                    $book = $result->fetch_assoc();

                    if (!$book) {
                        die("Book not found.");
                    }

                } else {
                    die("Book ID not provided.");
                }

                
                // Handle update form submission
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $id       = $_POST['id'];
                    $publisher   = $_POST['publisher'];
                    $available = $_POST['availability'];
                
                // update book details
                    $stmt = $conn->prepare("UPDATE books SET publisher = ?, availability = ? WHERE id = ?");
                $stmt->bind_param("sii",  $publisher, $available, $id);// s for string value, i for integer value
                    if ($stmt->execute()) {
                    echo "Book updated successfully.";
                    // Optionally redirect:
                    // header("Location: view_books.php?updated=1");
                    // exit;
                } else {
                    echo "Error updating book: " . $stmt->error;
                }
                }              

            ?>


           <div class="form-group">
           
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?=$book['id'] ?>">

                <label  class="text-info">Publisher:</label><br>
                <input type="text" name="publisher"  class="form-control" value="<?= htmlspecialchars($book['publisher']) ?>" required><br><br>

                <label  class="text-info">Available Copies:</label><br>
                <input type="number" name="availability"  class="form-control"  value="<?= $book['availability'] ?>" min="0" required><br><br>
            </div>  
               
                <div class="form-group">
                <input type="submit" name="submit" class="btn btn-info btn-md" value="Update Book">
               </div>
            </form>
             </div>
        </div>
    </div>
</div>
</div>
</body>
<?php
       include "../page_parts/footer.php";
   ?>   
</html>