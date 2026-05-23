<?php
session_start();
require_once "../config/db.php";
include "../page_parts/header.php";

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
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="/js/jquery.form.js"></script> 
    <title>Admin Dashboard</title>
</head>
<body>
     <header id="home-page">
        <nav class="nav">
           <div class="nav-container">
              
                      <a href="./index.html" class="nav-logo">
                        <img src="../img/university-logo.png" id="logo" alt="university Logo">
                        <span class="logo-text">Australia University LMS</span>
                       </a>
           </div>
        </nav>
     </header>
    <div class="admin-dash">
        <div><h1>Welcome, <?= $_SESSION['fname'] ?></h1></div>
          <h1> Change Password</h1>
           <div class="flex-container" id="flex-container">   
                <div class="flex-item-left" id="left">
                  <?php  
                      include "../page_parts/user-sidebar.php";  
                    ?>
                </div>
                <div class="flex-item-right" id="ad-content">
                 <?php
              
                // Check if form is submitted
                if (isset($_POST["submit"])) {
                    // Get user input and sanitize it to prevent SQL injection
                    $oldpass = $_POST["oldpass"];
                    $newpass = $_POST["newpass"];
                    $id = $_SESSION["user_id"];

                    //  Check if the old password is correct
                    $sql = "SELECT password FROM users WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);  // "i" is for integer type (id)
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Fetch the user data
                        $row = $result->fetch_assoc();
                        
                        // Verify the old password using password_verify()
                        if (password_verify($oldpass, $row['password'])) {
                            // Step 3: Hash the new password before updating
                            $hashed_newpass = password_hash($newpass, PASSWORD_DEFAULT);
                            
                            // Update the password in the database
                            $update_sql = "UPDATE users SET password = ? WHERE id = ?";
                            $update_stmt = $conn->prepare($update_sql);
                            $update_stmt->bind_param("si", $hashed_newpass, $id);  // "si" means string (hashed password) and integer (id)

                            if ($update_stmt->execute()) {
                                echo "<p class=''>Password changed successfully!</p>";
                            } else {
                                echo "<p class='error'>Error updating password.</p>";
                            }
                        } else {
                            echo "<p class='error'>Invalid old password.</p>";
                        }
                    }
                    $stmt->close();
                }

                 
                 /*
                        if(isset($_POST["submit"]))
                        {
                        $sql ="SELECT * FROM users WHERE password = '{$_POST["oldpass"]}' and id = '{$_SESSION["id"]}'"; 
                        $result =$conn->query($sql);
                        
                        if($result->num_rows>0)
                            {
                                $s ="UPDATE users SET password = '{$_POST["newpass"]}'  WHERE id =".$_SESSION["id"];
                                $conn->query($s);
                                echo "<p class='success'>Password changed successfully!</p>";

                            }
                        else
                            {
                                echo "<p class='error'> Invalid Password</p>";
                            }
                        }

                        */
                  ?>
     <table border="1" >        
     <form  action="<?php echo $_SERVER["PHP_SELF"];?>"  method="post"  id="change-pass">
                <tr>
                        <td><label for="oldpass">Old Password</label></td>
                        <td><input type="password" name="oldpass" id="oldpass" required>
                        </tr>

                          <tr>
                        <td><label for="newpass">New Password</label></td>
                        <td><input type="password" name="newpass" id="newpass" required></td>
                        </tr>

                        <tr align-"center">  
                        <td colspan="2"><button type="submit" name="submit" id="submit">Update Password</button></td>
                         </tr>
                   </form>
        </table>
                </div>
        
         </div>
    </div>

  <?php
       include "../page_parts/footer.php";
   ?>   
</body>
</html>

