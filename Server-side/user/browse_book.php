<?php
session_start();
require_once "../config/db.php";
include "../page_parts/header.php";

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'user'){
    header("location:./member-login-copy.php");
    exit;
}
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Book Collection</title>
   
     <link rel="stylesheet" href="../css/style.css">

     <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="/js/jquery.form.js"></script> 
</head>
<body>
<div class="admin-dash" >    
          
         <div class="flex-container">  
                <div class="flex-item-left">
                        <?php  
                            include "../page_parts/user-sidebar.php";  
                        ?>
                </div>
                <div class="flex-item-right" id="user-content">
                  <h1>Browse our E-books collections </h1>
                  <div class="book-grid">
                        <?php
                            $sql = "SELECT * FROM books";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0):
                                while($book = $result->fetch_assoc()):
                        ?>
                        <div class="book-card">
                            <img src="../img/<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                            <p><strong>Category:</strong> <?php echo htmlspecialchars($book['category']); ?></p>
                            <p><strong>Availability:</strong> <?php echo htmlspecialchars($book['availability']); ?></p>
                            <p> <a href="borrow.php?id=<?php echo $book['id']; ?>" >BORROW</a>
                        </div>
        <?php
            endwhile;
        else:
            echo "<p>No books found.</p>";
        endif;

        $conn->close();
        ?>
        </div>
                        
                </div>
        
         </div>
    </div>

  <?php
       include "../page_parts/footer.php";
   ?>   
</body>
</html>