<?php
   
   include "./page_parts/header.php";
   include "./config/db.php";

   if(isset($_POST['submit'])){

    //capture from data
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $email = $_POST['email'];
     $password =$_POST['password'];
     $cfpassword = $_POST['cfpassword'];
     $role = $_POST['role'];

     //hash password
     $hash = password_hash($password, PASSWORD_BCRYPT);

    //Sent to the database. Normally you will clean up here and test for scam and sql injection 
    //before sending to the database

    $sql = $conn->prepare ("INSERT INTO users (fname, lname, email, password, role) VALUES (?, ?, ?, ?,?)");
    $sql->bind_param("sssss", $fname,$lname, $email, $hash, $role);

    if($sql->execute()){
         echo '<h3> Registration successful! <a href="member-login-copy.php">Login</a></h3>';
        //Redirect the user to login automatically
        // header("Location:member-login-copy.php") ;
    }else{
         echo ("Error: ". $conn->error) ;
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
     <link rel="stylesheet" href="css/style.css">
    <title>Registration Form</title>
    <style>
     body{
           background-image: url('img/library-hero3.jpg');
        }
    </style>
</head>

<body class="login-container"> 
    
<section id="section">
<div class="wrapper">   

<div class="container">
   
<div id="register-row" class="row justify-content-center align-items-center">
<div id="register-column" class="col-md-7">
    <div id="register-box" class="col-md-5">
        
        <div>    
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="register-form" class="form" method="post" onsubmit="return validateSignUpForm();" novalidate>
            <h2>Registration Form</h2>  
           <div class="form-group">
                <h7><span>* </span>required</h7><br>
                <label for="fname" class="text-info">First Name<span>* </span>:</label>
                <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter your First name" required>
                <div class="invalid-feedback">
                    First Name cannot be empty! Contains only alpha characters
                </div>
            </div>
           <div class="form-group">
                <label for="lname" class="text-info">Last Name<span>* </span>:</label>
                <input type="text" name="lname" id="lname" class="form-control"  placeholder="Enter your Last name" required>
                <div class="invalid-feedback">
                    Last Name canot be empty! 
                </div>
           </div>
           <div class="form-group">
                <label for="email"  class="text-info">Email<span>* </span>: </label> 
                <input type="email" name="email" id="email"  class="form-control"  placeholder="Enter your Email ID here" required> 
                <div class="invalid-feedback">
                     A valid email addres is required!
                </div>
           </div>
           <div class="form-group">
                <label for="password" class="text-info">Password<span>* </span>:</label><br>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password here" required>
                <div class="invalid-feedback">
                        
                    A valid password is required! It should be 8 to 15 characters length,one uppercase, one lowercase, one number, one special character
                </div>
           </div>
           <div class="form-group">
                     <label for="cfpassword" class="text-info">Confirm Password<span>* </span>:</label><br>
                    <input type="password" name="cfpassword" id="cfpassword" class="form-control" placeholder="Re-type your password" required>
                    <div class="invalid-feedback">
                       Password do not match! 
                    </div>
            </div>
             <div class="form-group">
                    <input type="text" name="role" id="role" value="user" hidden>
            </div>
           <div class="form-group">
               <input type="submit" name="submit" class="btn btn-info btn-md" value="Sign Up">
            </div>
           <div>
              <p>Already have an Account? <a href="member-login.php">Registered User 
                    |</a><a href="admin-login.php">   Admin</a></p>
           </div>
         
        </form>
       </div>
        
    <script>
     function validateSignUpForm() {
   
				var e = "";
				var validity = true;
					
			    var fnameregex = /^[a-zA-Z]+$/;
                var lnameregex = /^[a-zA-Z]+$/;
                var emailregex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				var passwordregex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
                var cfpasswordregex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
              
					
				f = document.getElementById("fname");
                l= document.getElementById("lname");
                e = document.getElementById("email");
                p= document.getElementById("password");
                cp= document.getElementById("cfpassword");
              


                f.classList.remove("is-invalid");
                l.classList.remove("is-invalid");	
				e.classList.remove("is-invalid");
                p.classList.remove("is-invalid");	
                cp.classList.remove("is-invalid");
               

				if ( (f.value == "" )||!fnameregex.test(f.value)) {
					f.classList.add("is-invalid");
					validity = false;
				}

                if ( (l.value == "") ||!lnameregex.test(l.value)) {
					l.classList.add("is-invalid");
					validity = false;
				}
               
				if ( (e.value == "") || !emailregex.test(e.value) ) {
					e.classList.add("is-invalid");
					validity = false;
				}
				
                if ( (p.value == "") || !passwordregex.test(p.value) ) {
					p.classList.add("is-invalid");
					validity = false;
				}

                if ((cp.value == "") || !cfpasswordregex.test(cp.value)){
                    cp.classList.add("is-invalid");
                    validity = false;
                     }

				return validity;
			}	
     </script>
 </div>
      
</div>
</div>
</div>

</div>
</section>

<?php
  /*if(isset($_POST['submit']))
  {
    //$sql ="";
    mysqli_query($db, "");
  }

  */
?>


<?php  include "./page_parts/footer.php";?>
</body>
</html>



