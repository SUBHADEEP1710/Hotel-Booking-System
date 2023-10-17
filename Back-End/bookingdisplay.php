<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "hoteldatabase";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT r.check_in_date, r.check_out_date, r.adults, r.children, r.total_price, r.first_name, r.last_name, h.hotel_name, hr.room_type
          FROM reservations r
          LEFT JOIN hotels h ON r.hotel_id = h.hotel_id
          LEFT JOIN hotelrooms hr ON r.room_id = hr.room_id";
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