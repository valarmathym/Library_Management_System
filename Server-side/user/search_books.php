<?php
session_start();
require_once "../config/db.php";
include "../page_parts/header.php";

//if(!isset($_SESSION['user_id'] || $_SESSION["role"] !== 'user')){
 //   header("location:./member-login-copy.php");
//}
   $id = $_SESSION['user_id'];
 

   ?>

<!DOCTYPE html>
<html lang=
"en">
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
   
    <div class="admin-dash">
        <div><h1>Welcome, <?= $_SESSION['fname'] ?></h1></div><br>
          <h1> Search Book</h1><br>
          
           <div class="flex-container">  
                <div class="flex-item-left">
                    <?php  
                        include "../page_parts/user-sidebar.php";  
                    ?>
                </div>
               
                <div class="flex-item-right" id="ad-content">
                    
                    <div class="search">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <p>
                    
                        <label for="title" class="text-info">Title: </label>
                        <input type="text" class="form-control" name="title" id="title" required>
                       </p>
                        <p><input type="submit" name="submit" class="btn btn-info btn-md" value="SEARCH"></p>
                        </form>
                    
                    <?php
                     // $title = mysqli_real_escape_string($conn,$_POST["title"]); // wrong statement . need to check if it os empty
                       if (isset($_POST['title'])) {
                        $title = trim($_POST['title']);

                        if (empty($title)) {
                            echo "Please fill in the title of the book!";
                        } else {
                            // Proceed with the search 
                        
                        $result = mysqli_query($conn, "SELECT * FROM books where title = '$title' order by id DESC");
                        $intCount = mysqli_num_rows($result);   
                        if($intCount == 1){
                       
                            echo "<p><strong>Here is your Requested book !</strong></p>";
                        }
                    }
                        if($result->num_rows>0)
                            {
                          
                            echo "<table>
                            <tr>
                                   
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Language</th>
                                    <th>Category</th>
                                    <th colspan='2'>Action</th>
                                    
                            </tr>";
                             
                            $i=0;
                            while($row = $result->fetch_assoc())
                            {
                                $i++;
                                echo "<tr>";
                                    
                                    echo "<td>{$row["title"]}</td>";
                                    echo "<td>{$row["author"]}</td>";
                                    echo "<td>{$row["publisher"]}</td>";
                                    echo "<td>{$row["language"]}</td>";
                                    echo "<td>{$row["category"]}</td>";
                                    echo "<td colspan='2'><a href='https://www.gutenberg.org/files/1400/1400-h/1400-h.htm?id=". $row['id'] ."'> BROWSE BOOK</a> | <a href='borrow.php?id=" . $row['id'] . "'>BORROW</a></td>";
                                 echo "</tr>";

                            } 
                                echo "</table>";
                            
                        }
                        else{
                            echo "<p class='error'>Please fill in the title of the book! </p>";
                        }
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