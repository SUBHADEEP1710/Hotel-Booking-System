<?php
try {
    // Connect to the hotel_booking database
    $bookingdb = new PDO('mysql:host=localhost;dbname=hotel_booking', 'root', '');

    // Connect to the hoteldatabase
    $hoteldb = new PDO('mysql:host=localhost;dbname=hoteldatabase', 'root', '');

   
    $fetchUserQuery = "SELECT first_name, last_name FROM users";
    $fetchUserStmt = $bookingdb->prepare($fetchUserQuery);
    $fetchUserStmt->bindParam($fetchUserQuery,PDO::PARAM_STR);
    $fetchUserStmt->execute();

    // Fetch user data
    $userData = $fetchUserStmt->fetch(PDO::FETCH_ASSOC);

    // Now, you can access both user_id, first_name, and last_name

    $first_name = $userData['first_name'];
    $last_name = $userData['last_name'];


    $hotel_id = isset($_GET['location']) ? $_GET['location'] : ''; // Replace with proper validation
    $check_in_date = isset($_GET['check-in']) ? $_GET['check-in'] : ''; // Replace with proper validation
    $check_out_date = isset($_GET['check-out']) ? $_GET['check-out'] : ''; // Replace with proper validation
    $adults = isset($_GET['adults']) ? $_GET['adults'] : 1; // Replace with proper validation
    $children = isset($_GET['children']) ? $_GET['children'] : 0; // Replace with proper validation
    

    // Insert the reservation data into the reservation table in the hoteldatabase
    $insertReservationQuery = "INSERT INTO reservation 
        (hotel_id, room_id, check_in_date, check_out_date, adults, children, total_price, first_name, last_name)
        VALUES (:hotel_id, :room_id, :check_in_date, :check_out_date, :adults, :children, :total_price, :first_name, :last_name)";
    $insertReservationStmt = $hoteldb->prepare($insertReservationQuery);

    // Bind the parameters and execute the insert query
    $insertReservationStmt->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
    $insertReservationStmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
    $insertReservationStmt->bindParam(':check_in_date', $check_in_date, PDO::PARAM_STR);
    $insertReservationStmt->bindParam(':check_out_date', $check_out_date, PDO::PARAM_STR);
    $insertReservationStmt->bindParam(':adults', $adults, PDO::PARAM_INT);
    $insertReservationStmt->bindParam(':children', $children, PDO::PARAM_INT);
    $insertReservationStmt->bindParam(':total_price', $total_price, PDO::PARAM_STR);
    $insertReservationStmt->bindParam(':first_name', $userData['first_name'], PDO::PARAM_STR);
    $insertReservationStmt->bindParam(':last_name', $userData['last_name'], PDO::PARAM_STR);

    // Execute the insert query
    if ($insertReservationStmt->execute()) {
        echo "Reservation record inserted successfully.";
    } else {
        echo "Error inserting reservation record: " . implode(" - ", $insertReservationStmt->errorInfo());
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
