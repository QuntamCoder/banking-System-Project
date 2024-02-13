<?php
// Assuming you have a database connection established
include('config.php');

// Check if login button is clicked
if (isset($_POST['login_button'])) {
    // Retrieve username and password from the form
    $user_name = $_POST['user_name'];
    $password = $_POST['pass'];

    // Validate login credentials
    $sql = "SELECT * FROM employee_signup WHERE user_name = '$user_name' AND pass = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Redirect to index.html if login is successful
        header("Location: index.html");
        exit();
    } else {
        // Display an error message or redirect to login page
        echo "Invalid username or password";
    }
}

$conn->close();
?>
