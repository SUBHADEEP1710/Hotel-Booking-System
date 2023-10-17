<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $host = "localhost"; // Replace with your actual database host
    $username = "root"; // Replace with your actual database username
    $password = ""; // Replace with your actual database password
    $database = "hotel_booking"; // Replace with your actual database name

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input from the form
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $contactNumber = $_POST['contact-number'];
    $email = $_POST['signup-email'];
    $password = $_POST['signup-password']; // Hash the password for security

    // SQL query to insert the user data into the "users" table
    $sql = "INSERT INTO users (first_name, last_name, contact_no, email, password, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstName, $lastName, $contactNumber, $email, $password);
    
    if ($stmt->execute()) {
        header("Location: index3.php");
        exit; // Terminate the script to ensure immediate redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>