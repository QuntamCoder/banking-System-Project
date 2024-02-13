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
            $popupMessage = 'Signup successful!';
            header('Refresh: 3; URL=login.html');

        } else {
            $popupMessage = 'Error: ' . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
