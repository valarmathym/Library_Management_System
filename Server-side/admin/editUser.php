
<?php
require_once "../config/db.php";
include "../page_parts/header.php";
session_start();


if(!isset($_SESSION["user_id"])){
    header("location:./admin-login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("User ID not provided.");
}

$id = (int)$_GET['id'];
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
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <div class="wrapper">
    <div class="admin-dash">
          <h1> Edit User Details</h1><br>
          
          <div class="flex-container">  
                <div class="flex-item-left">
                    <?php  
                        include "../page_parts/admin-sidebar.php";  
                    ?>
                </div>
               
                <div class="flex-item-right" id="ad-content">
    <?php


// Handling POST request for update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    $stmt2 = $conn->prepare("UPDATE users SET lname = ?, email = ? WHERE id = ?");
    $stmt2->bind_param("ssi", $lname, $email, $id);

    if ($stmt2->execute()) {
        echo "<p style:color: 'purple';>User updated successfully! </p>";
        // Optionally redirect:
        // header("Location: view_users.php");
        // exit;
    } else {
        echo "Error updating user: " . $stmt2->error;
    }
}

// Get user data for display in form
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$row = $result->fetch_assoc();
?>

<table border="1" class="edit-user">
<form method="POST" action="">
    <div class="form-group">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

            <label for="lname"  class="text-info">Last Name:</label>
            <input type="text" id="lname" name="lname"  class="form-control" value="<?php echo htmlspecialchars($row['lname']); ?>" required><br><br>

            <label for="email"  class="text-info">Email:</label>
            <input type="email" id="email" name="email"  class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>" required><br><br>
    </div>      
     <div class="form-group">
            <button type="submit" class="btn btn-info btn-md" value="Update User">Update User</button>
          
      </div>
</form>
</table>
</div>
</div>
</div>
</div>

</body>
</html>
