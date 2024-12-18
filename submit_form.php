<?php
// Include the database connection and function file
include 'db_connect.php'; 

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Call the function to save data to the database
    $result = saveData($name, $email, $message);
    
    // Display the result
    echo $result;
}
?>

