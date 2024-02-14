<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="stylesheet/singup.css">
  <!-- Include SweetAlert library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
  <div class="container1">
    <div class="flex">
      <div class="img"></div>
      <div class="signup">
        <div class="signup-form">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2 class="text-center"><strong>Login</strong></h2>

            <div class="form-group"><input class="form-control" name="user_name" placeholder="User name"></div>
            <div class="form-group"><input class="form-control" name="pass" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-secondary btn-block" type="submit" name="login_button">Sign Up</button></div>
            <span>Don't have an account?</span><a class="already" href="signup.php"> Login here.</a>
          </form>
          <p id="exampleInput"></p>

          <?php
          // Start the session
          session_start();

          // Assuming you have a database connection established
          include('config.php');

          // Initialize a variable to track successful login
          $loginSuccess = false;

          // Check if login button is clicked
          if (isset($_POST['login_button'])) {
            // Retrieve username and password from the form
            $user_name = $_POST['user_name'];
            $password = $_POST['pass'];

            // Fetch the hashed password from the database based on the provided username
            $sql = "SELECT pass, emp_name FROM employee_signup WHERE user_name = '$user_name'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $hashed_password_from_db = $row['pass'];

              // Verify the entered password against the stored hashed password
              if (password_verify($password, $hashed_password_from_db)) {
                // Set the loginSuccess variable to true
                $loginSuccess = true;
                header('Refresh: 2; URL=home.php');

                // Set the user_name session variable
                $_SESSION['user_name'] = $row['emp_name'];

                // Display a SweetAlert if login is successful
              }else{
                $loginSuccess = false;

              }
            }
          }

          $conn->close();
          ?>
          <script>
            var jsVariable = <?php echo json_encode($loginSuccess); ?>;

            function popup() {
              if (jsVariable === true) {
                Swal.fire({
                  title: "Login successful!",
                  text: "Welcome here, <?php echo $_SESSION['user_name']; ?>!",
                  icon: "success",
                  confirmButtonText: "OK"
                });
              } else
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "You Have Entered wrong Password !",
                  // footer: '<a href="#">Why do I have this issue?</a>'
                });
            }

            // Call the popup function
            popup();
          </script>
        </div>
      </div>
    </div>
</body>

</html>