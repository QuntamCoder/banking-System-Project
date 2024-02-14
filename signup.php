<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="stylesheet/singup.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <style>
    /* Add your custom pop-up styles here */
</style>

</head>
<body>

<div class="container1">
  <div class="flex">
    <div class="img">
      <!-- Your image content goes here -->
    </div>
    <div class="signup">
      <div class="signup-form">
        <!-- Your existing form code goes here -->
        <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <h2 class="text-center"><strong>Create</strong> an account.</h2>
          <div class="form-group"><input class="form-control" name="emp_id" placeholder="Employee id"></div>
          <div class="form-group"><input class="form-control"  name="emp_name" placeholder="Employee Name"></div>
          <div class="form-group"><input class="form-control"  name="emp_desg" placeholder="Employee designation"></div>
          <div class="form-group"><input class="form-control"  name="user_name" placeholder="User name"></div>
          <div class="form-group"><input class="form-control"  name="pass" placeholder="Password"></div>
          <div class="form-group"><input class="form-control"  name="c_pass" placeholder="Confirm Password"></div>
          <div class="form-group">
            <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox">I agree to the license terms.</label></div>
          </div>
          <div class="form-group"><button class="btn btn-secondary btn-block" type="submit" onclick="popup()">Sign Up</button>
</div>
          <a class="already" href="login.php"> Already have an account? Login here.</a>
        </form>
        <?php
// Include the database configuration
include('config.php');

// Initialize variables
$popupMessage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    $emp_desg = $_POST['emp_desg'];
    $user_name = $_POST['user_name'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['c_pass'];

    // Validate that password and confirm password match
    if ($password !== $confirm_password) {
        $popupMessage = 'Password and Confirm Password do not match.';
    } else {
        // Hash the password for security (use password_hash function)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the Employee_Signup table
        $sql = "INSERT INTO employee_signup (emp_id, emp_name, emp_desg, user_name, pass) 
                VALUES ('$emp_id', '$emp_name', '$emp_desg', '$user_name', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $popupMessage = true;
            header('Refresh: 3; URL=login.php');

        } else {
            $popupMessage =false;
        }
    }
}

// Close the database connection
$conn->close();
?>

      </div>
    </div>
  </div>
</div>
<script>
    var jsVariable = <?php echo json_encode($popupMessage); ?>;
    
    function popup() {
        if (jsVariable === true) {
            Swal.fire({
                title: "SignUp successful!",
                text: "Account Created Successfully",
                icon: "success",
                confirmButtonText: "OK"
            });
        }
    }

    // Call the popup function on page load
    window.onload = popup;
</script>
<!-- Popup container -->

</body>
</html>
