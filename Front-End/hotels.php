<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>List of Hotels</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Mooli&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {

            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin: 20px 0;
        }

        .hotel-card {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .hotel-card h2 {
            font-size: 24px;
            margin: 0;
        }

        .hotel-card img {
            width: 450px;
            height: auto;
            margin-right: 40px;
            margin-bottom: 20px;
        }

        .hotel-card p {

            font-size: 16px;
        }

        .book-button {
            margin-top: 40px;
            display: block;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
            position: 20px;
            bottom: 20px;
            margin-left: 50%;
            transform: translateX(-50%);
        }

        .book-button:hover {
            background-color: #0056b3;
        }

        .filter-section {
            background-color: #f5f5f5;
            padding: 20px;
            border-bottom: 1px solid #ccc;
        }

        .filter-section input[type="text"],
        .filter-section input[type="date"],
        .filter-section input[type="number"] {
            padding: 10px;
            margin-right: 20px;
        }

        .filter-section button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
        }

        .filter-section button:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>
    <h1>List Of Hotels Available</h1>

    <div class="filter-section">
        <input type="text" name="location" placeholder="Location" value="<?php echo isset($_GET['location']) ? $_GET['location'] : ''; ?>">
        <input type="date" name="check-in" value="<?php echo isset($_GET['check-in']) ? $_GET['check-in'] : ''; ?>">
        <input type="date" name="check-out" value="<?php echo isset($_GET['check-out']) ? $_GET['check-out'] : ''; ?>">
        <input type="number" name="adults" value="<?php echo isset($_GET['adults']) ? $_GET['adults'] : '1'; ?>">
        <input type="number" name="children" value="<?php echo isset($_GET['children']) ? $_GET['children'] : '0'; ?>">
        <button onclick="applyFilters()">Filter Hotels</button>
    </div>

    <?php

    $location = isset($_GET['location']) ? $_GET['location'] : '';
    $checkIn = isset($_GET['check-in']) ? $_GET['check-in'] : '';
    $checkOut = isset($_GET['check-out']) ? $_GET['check-out'] : '';
    $adults = isset($_GET['adults']) ? $_GET['adults'] : 1;
    $children = isset($_GET['children']) ? $_GET['children'] : 0;

    $pdo = new PDO('mysql:host=localhost;dbname=hoteldatabase', 'root', '');

    $checkIn = new DateTime($checkIn);
    $checkOut = new DateTime($checkOut);
    $totalDays = $checkIn->diff($checkOut)->days;

    $sql = "SELECT hotels.hotel_name,hotels.image_url, hotels.location, hotels.address, hotels.phone_number, hotelrooms.price, hotelrooms.room_type
        FROM hotels
        INNER JOIN hotelrooms ON hotels.hotel_id = hotelrooms.hotel_id
        WHERE hotels.location = :location
        AND hotelrooms.capacity >= :capacity
        GROUP BY hotels.hotel_id
        ORDER BY hotels.hotel_name";




    $stmt = $pdo->prepare($sql);


    $stmt->bindParam(':location', $location, PDO::PARAM_STR);
    $stmt->bindValue(':capacity', $adults + $children, PDO::PARAM_INT);


    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="hotel-card">';
        echo '<h2>' . $row['hotel_name'] . '</h2>';
        echo '<img src="' . $row['image_url'] . '" alt="' . $row['hotel_name'] . ' Image" style="float: left;">';
        echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
        echo '<p><strong>Address:</strong> ' . $row['address'] . '</p>';
        echo '<p><strong>Contact:</strong> ' . $row['phone_number'] . '</p>';
        echo '<p><strong>Price:</strong> ' . $row['price'] . '</p>';
        echo '<p><strong>Room Type:</strong> ' . $row['room_type'] . '</p>';
        $totalAmountPaid = $row['price'] * $totalDays;
        echo '<p><strong>Total Amount Paid:</strong> Rs.' . $totalAmountPaid . '</p>';
        echo '<a href="payment_gateway.html" class="book-button">Book</a>';
        echo '</div>';
    }

    $prevHotelId = null;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($prevHotelId !== $row['hotel_id']) {
            if ($prevHotelId !== null) {
                echo '</div>';
            }
            echo '<div class="hotel-card">';
            echo '<h2>' . $row['hotel_name'] . '</h2>';
            $prevHotelId = $row['hotel_id'];
        }
    }
    if ($prevHotelId !== null) {
        echo '</div>';
    }


    $pdo = null;
    ?>

    <?php
    try {
        $bookingdb = new PDO('mysql:host=localhost;dbname=hotel_booking', 'root', '');
        $hoteldb = new PDO('mysql:host=localhost;dbname=hoteldatabase', 'root', '');

        // Query to get the last inserted user_id
        $lastUserIdQuery = "SELECT user_id FROM users ORDER BY created_at DESC LIMIT 1";
        $stmtLastUserId = $bookingdb->query($lastUserIdQuery);

        if ($stmtLastUserId) {
            $lastUserId = $stmtLastUserId->fetchColumn();

            // Fetch user details (first name and last name)
            $fetchUserQuery = "SELECT first_name, last_name FROM users WHERE user_id = :user_id";
            $fetchUserStmt = $bookingdb->prepare($fetchUserQuery);
            $fetchUserStmt->bindParam(':user_id', $lastUserId, PDO::PARAM_INT);
            $fetchUserStmt->execute();
            $userData = $fetchUserStmt->fetch(PDO::FETCH_ASSOC);

            if (isset($userData) && isset($userData['first_name']) && isset($userData['last_name'])) {
                $first_name = $userData['first_name'];
                $last_name = $userData['last_name'];


                // User input from the filter section
                $location = isset($_GET['location']) ? htmlspecialchars($_GET['location']) : '';
                $check_in_date = isset($_GET['check-in']) ? $_GET['check-in'] : '';
                $check_out_date = isset($_GET['check-out']) ? $_GET['check-out'] : '';
                $adults = isset($_GET['adults']) ? $_GET['adults'] : 1;
                $children = isset($_GET['children']) ? $_GET['children'] : 0;

                // Get hotel_id based on location
                $getHotelIdQuery = "SELECT hotel_id FROM hotels WHERE location = :location LIMIT 1";
                $getHotelIdStmt = $hoteldb->prepare($getHotelIdQuery);
                $getHotelIdStmt->bindParam(':location', $location, PDO::PARAM_STR);
                $getHotelIdStmt->execute();
                $hotelIdData = $getHotelIdStmt->fetch(PDO::FETCH_ASSOC);

                // Calculate the total capacity (adults + children)
                $capacityValue = $adults + $children;

                // Get room_id based on hotel_id, capacity, and availability
                $getRoomIdQuery = "SELECT room_id FROM hotelrooms 
                    WHERE hotel_id = :hotel_id AND capacity >= :capacity 
                    AND room_id NOT IN (
                        SELECT room_id FROM reservations 
                        WHERE (check_in_date <= :check_out_date AND check_out_date >= :check_in_date)
                    ) 
                    LIMIT 1";

                $getRoomIdStmt = $hoteldb->prepare($getRoomIdQuery);
                $getRoomIdStmt->bindParam(':hotel_id', $hotelIdData['hotel_id'], PDO::PARAM_INT);
                $getRoomIdStmt->bindParam(':capacity', $capacityValue, PDO::PARAM_INT);
                $getRoomIdStmt->bindParam(':check_in_date', $check_in_date, PDO::PARAM_STR);
                $getRoomIdStmt->bindParam(':check_out_date', $check_out_date, PDO::PARAM_STR);
                $getRoomIdStmt->execute();

                $roomData = $getRoomIdStmt->fetch(PDO::FETCH_ASSOC);
                $room_id = isset($roomData['room_id']) ? $roomData['room_id'] : null;
                $room_id = $roomData['room_id'];

                // Get room price
                $getPriceQuery = "SELECT price FROM hotelrooms WHERE room_id = :room_id LIMIT 1";
                $getPriceStmt = $hoteldb->prepare($getPriceQuery);
                $getPriceStmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
                $getPriceStmt->execute();
                $priceData = $getPriceStmt->fetch(PDO::FETCH_ASSOC);
                $price = isset($priceData['price']) ? $priceData['price'] : null;
                $price = $priceData['price'];

                $checkIn = new DateTime($check_in_date);
                $checkOut = new DateTime($check_out_date);
                $totalDays = $checkIn->diff($checkOut)->days;
                $total_price = $price * $totalDays;

                // Insert reservation data into the reservations table
                $insertReservationQuery = "INSERT INTO reservations 
                    (hotel_id, room_id, check_in_date, check_out_date, adults, children, total_price, first_name, last_name)
                    VALUES (:hotel_id, :room_id, :check_in_date, :check_out_date, :adults, :children, :total_price, :first_name, :last_name)";
                $insertReservationStmt = $hoteldb->prepare($insertReservationQuery);

                $insertReservationStmt->bindParam(':hotel_id', $hotelIdData['hotel_id'], PDO::PARAM_INT);
                $insertReservationStmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
                $insertReservationStmt->bindParam(':check_in_date', $check_in_date, PDO::PARAM_STR);
                $insertReservationStmt->bindParam(':check_out_date', $check_out_date, PDO::PARAM_STR);
                $insertReservationStmt->bindParam(':adults', $adults, PDO::PARAM_INT);
                $insertReservationStmt->bindParam(':children', $children, PDO::PARAM_INT);
                $insertReservationStmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
                $insertReservationStmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
                $insertReservationStmt->bindParam(':total_price', $total_price, PDO::PARAM_STR);

                $insertReservationStmt->execute();
            } else {
                echo "Error: Unable to fetch user details.";
            }
        } else {
            echo "Error fetching the last user_id.";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }





    ?>