<?php
$host = "localhost";  // Use localhost or 127.0.0.1 if MySQL is on the same server
$db_name = "dev_to";  // Your database name
$username = "user";  // Your MySQL username
$password = "password@12345";  // Your MySQL password

$connection = null;
try {
    // Creating PDO connection
    $connection = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    $connection->exec("set names utf8");  // Set the character encoding to UTF-8
} catch (PDOException $exception) {
    // If connection fails, output the error message
    die("Connection error: " . $exception->getMessage());  // Terminate execution on failure
}

function saveData($name, $email, $message) {
    global $connection;

    // SQL query to insert data
    $query = "INSERT INTO test(name, email, message) VALUES(:name, :email, :message)";

    // Prepare the query
    $callToDb = $connection->prepare($query);

    // Sanitize the input values
    $name = htmlspecialchars(strip_tags($name));
    $email = htmlspecialchars(strip_tags($email));
    $message = htmlspecialchars(strip_tags($message));

    // Bind the parameters to the query
    $callToDb->bindParam(':name', $name);
    $callToDb->bindParam(':email', $email);
    $callToDb->bindParam(':message', $message);

    // Execute the query and check if the query was successful
    try {
        if ($callToDb->execute()) {
            return "Data saved successfully!";
        } else {
            return "Failed to save data.";
        }
    } catch (PDOException $exception) {
        return "Error: " . $exception->getMessage();
    }
}
?>

