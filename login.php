<?php
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
    $sql = "SELECT pass FROM employee_signup WHERE user_name = '$user_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password_from_db = $row['pass'];

        // Verify the entered password against the stored hashed password
        if (password_verify($password, $hashed_password_from_db)) {
            // Set the loginSuccess variable to true
            $loginSuccess = true;

            // Redirect to index.html if login is successful
            header("Location: index.html");
            exit();
        } else {
            // Display an error message or redirect to login page
            echo "Invalid password";
        }
    } else {
        // User not found
        echo "Invalid username";
    }
}

$conn->close();
?>

