<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "hotel_booking";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT first_name, last_name, contact_no, email FROM users";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo "No data found.";
}

$conn->close();
?>