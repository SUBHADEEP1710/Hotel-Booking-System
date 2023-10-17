<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking Confirmation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Mooli&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {

            font-family: 'Poppins', sans-serif;
            background-color: black;
            margin: 0;
            padding: 0;
        }

        .hotel-header {
            background-size: cover;
            color: #fff;
            text-align: center;
            padding: 50px 0;
        }

        .confirmation-box {

            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            margin: 0px auto;
            margin-bottom: 50px;
            max-width: 800px;

        }

        .confirmation-details {
            margin-left: 20px;
            margin-bottom: 20px;
            padding: 10px;
        }

        .confirmation-details h2 {
            font-size: 28px;
            color: #333;
        }

        .confirmation-details p {
            font-size: 18px;
            color: #555;
        }

        .hotel-footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }


        .logout-button {
            margin-top: 20px;
            margin-right: 20px;
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout-button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <header class="hotel-header">
        <h1>Hotel Booking Confirmation</h1>
        <a href="logout_user.php" class="logout-button">Logout</a>

    </header>
    <main>
        <div class="confirmation-box">

            <div class="confirmation-details">
                <h2>Thank you for your booking!</h2>
                <p>Your hotel reservation has been confirmed.</p>
                <h3>Reservation Details</h3>
                <?php
                // Connect to your database

                try {
                    $conn = new PDO('mysql:host=localhost;dbname=hoteldatabase', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

                    // Query to get the last inserted reservation_id
                    $lastReservationIdQuery = "SELECT reservation_id FROM reservations ORDER BY reserved_at DESC LIMIT 1";
                    $stmtLastReservationId = $conn->query($lastReservationIdQuery);

                    if ($stmtLastReservationId) {
                        $lastReservationId = $stmtLastReservationId->fetchColumn();

                        // SQL query to retrieve details of the reservation based on reservation_id
                        $reservationDetailsQuery = "SELECT * FROM reservations WHERE reservation_id = :reservation_id";
                        $stmtReservationDetails = $conn->prepare($reservationDetailsQuery);
                        $stmtReservationDetails->bindParam(':reservation_id', $lastReservationId, PDO::PARAM_INT);
                        $stmtReservationDetails->execute();
                        $reservationData = $stmtReservationDetails->fetch(PDO::FETCH_ASSOC);

                        if ($reservationData) {
                            echo "<table>";
                            echo "<tr><td>First Name:</td><td>" . $reservationData["first_name"] . "</td></tr>";
                            echo "<tr><td>Last Name:</td><td>" . $reservationData["last_name"] . "</td></tr>";
                            echo "<tr><td>Check-in Date:</td><td>" . $reservationData["check_in_date"] . "</td></tr>";
                            echo "<tr><td>Check-out Date:</td><td>" . $reservationData["check_out_date"] . "</td></tr>";
                            echo "<tr><td>Adults:</td><td>" . $reservationData["adults"] . "</td></tr>";
                            echo "<tr><td>Children:</td><td>" . $reservationData["children"] . "</td></tr>";
                            echo "<tr><td>Total price paid:</td><td>" . $reservationData["total_price"] . "</td></tr>";

                            $hotel_id = $reservationData["hotel_id"];
                            $hotel_sql = "SELECT hotel_name FROM hotels WHERE hotel_id = :hotel_id";
                            $stmtHotel = $conn->prepare($hotel_sql);
                            $stmtHotel->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
                            $stmtHotel->execute();
                            $hotelData = $stmtHotel->fetch(PDO::FETCH_ASSOC);

                            if ($hotelData) {
                                echo "<tr><td>Hotel Name:</td><td>" . $hotelData["hotel_name"] . "</td></tr>";
                            }

                            $room_id = $reservationData["room_id"];
                            $room_sql = "SELECT room_type FROM hotelrooms WHERE room_id = :room_id";
                            $stmtRoom = $conn->prepare($room_sql);
                            $stmtRoom->bindParam(':room_id', $room_id, PDO::PARAM_INT);
                            $stmtRoom->execute();
                            $roomData = $stmtRoom->fetch(PDO::FETCH_ASSOC);

                            if ($roomData) {
                                echo "<tr><td>Room Type:</td><td>" . $roomData["room_type"] . "</td></tr>";
                            }

                            echo "</table>";
                        } else {
                            echo "Error fetching reservation details.";
                        }
                    } else {
                        echo "Error fetching the last reservation_id.";
                    }

                    $conn = null;
                } catch (PDOException $e) {
                    die("Error: " . $e->getMessage());
                }

                ?>




            </div>
        </div>
    </main>
</body>

</html>