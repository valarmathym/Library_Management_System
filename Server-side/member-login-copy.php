<?php
      include "./page_parts/header.php";
      include "./config/db.php";
      session_start();

//Authenticate user
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    //plain text password entered by the user
    $password = $_POST['password'];
    
   // Prepared statement to avoid sql injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    //print_r($result);

    if ($result->num_rows > 0) {
         echo " Success! ..User exists.... ";
        $row = $result->fetch_assoc();
        
        // Checking if the password matches the hashed one in DB
        if (password_verify($password, $row['password'])) {
            // Start session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['role'] = $row['role'];
                if($_SESSION['role']=='admin'){
                        header("Location:./admin/dashboard_admin1.php");
                        exit();
                    }else{
                        header("Location:./user/dashboard_user.php");
                        exit();
                    }
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
}
?>  

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
     integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

     <link rel="stylesheet" href="css/style.css">
    <title>User Login Form</title>

    <style>
        body{
           background-image: url('img/library-hero3.jpg');
        }
    </style>
    
</head>

<body class="login-container">
     
<section id="section">
 <div class="wrapper">    
<div id="login-row" class="row justify-content-center align-items-left">
<div id="login-column" class="col-md-7">
    
<div id="login-box" class="col-md-28">
      
     <div id="decor-member">
         
            <form  action="<?php $_SERVER["PHP_SELF"];?>" id="member-login" class="form" method="post"  onsubmit="return validateForm()" novalidate>
                 <h2> User Login</h2>   
 
                <div class="form-group">
                    <label for="email"  class="text-info">User ID: </label> 
                    <input type="email" name="email" id="email"  class="form-control" placeholder="Enter your Email ID here"  required>
                    <div class="invalid-feedback">
                        A valid email addres is required!
                    </div>
                </div> 
                
                <div class="form-group">
                    <label for="password" class="text-info">Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Type your password" required>
                    <div class="invalid-feedback">
                        A valid password is required! It should be 8 to 15 characters length,one uppercase,
                         one lowercase, one number, one special character
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Log in">
                </div>
                <div> New User? Please<a href="signup.php"> Sign Up</a> </div>
            </form> 
        </div>

          
         <!---------------------   Javascript for custom form validation  --------------------->
         <script>
            
 function validateForm() {
   
				var e = "";
				var validity = true;
					
                var emailregex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				var passwordregex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
					
				e = document.getElementById("email");
                p= document.getElementById("password");
                
				e.classList.remove("is-invalid");
                p.classList.remove("is-invalid");	

				if ( (e.value == "") || !emailregex.test(e.value) ) {
					e.classList.add("is-invalid");
					validity = false;
				}else
				
                if ( (p.value == "") || !passwordregex.test(p.value) ) {
					p.classList.add("is-invalid");
					validity = false;
				}
				return validity;
			}	

         </script>
         
    </div>
        
</div>
</div>
</div>

</section>

</body>

</html>
<?php 
include "./page_parts/footer.php";
?>


