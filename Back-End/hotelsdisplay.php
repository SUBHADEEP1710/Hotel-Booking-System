<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "hoteldatabase";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT hotel_name, location, check_in_time, check_out_time, total_rooms, phone_number, address FROM hotels";
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

