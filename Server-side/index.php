
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap 4 CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
     integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <!--Bootstrap5 CSS   
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     ---->
     
     <link rel="stylesheet" href="./css/style.css">
      <style> 
        body{
            background-image: url('img/library-hero3.jpg');
         }
       </style>
   
    <title>AU Library Management System</title>
  </head>
  <body>
    <div class="wrapper">
       <header id="home-page">
        <nav class="nav">
           <div class="nav-container">
              
                      <a href="index.html" class="nav-logo">
                        <img src="img/university-logo.png" id="logo" alt="university Logo">
                        <span class="logo-text">Australia University LMS</span>
                       </a>
              
                  <input type="checkbox" id="menu-toggle">         
                    <label for="menu-toggle" class="hamburger"> 
                          <span class="bar"></span>            
                          <span class="bar"></span>            
                          <span class="bar"></span>                      
                    </label>

                    <ul class="nav-menu">
                         <li class="nav-item"><a href="index.php" class="nav-link">HOME</a></li>
                        <li class="nav-item"><a href="about.php" class="nav-link">ABOUT US</a></li>
                        <li class="nav-item"><a href="services.php" class="nav-link">OUR SERVICES</a></li>
                        <li class="nav-item"><a href="./user/browse_book.php" class="nav-link">COLLECTIONS</a></li>
                        <li class="nav-item"><a href="member-login-copy.php" class="nav-link">USER LOGIN</a></li>
                        <li class="nav-item"><a href="admin-login.php" class="nav-link">ADMIN LOGIN</a></li>
                        <li class="nav-item"><a href="signup.php" class="nav-link">REGISTER</a></li>
                    </ul>
          </div>
       </nav> 
     </header>
      <section id="index-section">
          
            <div class="container mx-auto">
              <br>
            <h2 style="text-align: center; font-size: 2.1rem;">Today's Opening hours</h2><br>
            </div>
             <div class="box">
              <br><br>
                <ul>
                    <li>Law Library  :   7 : 00 AM  -   6 : 00 PM</li><br>
                    <li >Main Library :   7:00 AM  -  10:00 PM </li><br>
                    <li>Help Zone Staff: 11:00 AM - 4:00 PM</li><br>
                </ul>
            </div>
        
        </section>
        <?php 
          include "./page_parts/footer.php";
          ?>
    </div>
  </body>
</html>