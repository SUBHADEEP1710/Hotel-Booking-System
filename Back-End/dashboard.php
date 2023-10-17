<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_name'])) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Mooli&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<style>
   
body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}

.sidebar {
    width: 250px;
    height: 100%;
    background-color: #333;
    position: fixed;

}

.nav-button {
    width: 100%;
    padding: 15px;
    background-color: #444;
    border: none;
    color: #fff;
    text-align: left;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    font-size: 24px;
}
.nav-button:hover {
    background-color: #555;
}

.content {
    margin-left: 250px;
    padding: 20px;
}

#content-display {
    font-size: 25px;
    margin: 20px;

}

a.logout-button {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 10px 20px;
    background-color: #E74C3C;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s; /* Add a smooth transition for background color */
}

a.logout-button:hover {
    background-color: #C0392B; /* Change background color on hover */
}
.hotel-table {
    border-collapse: collapse;
    width: 100%;
}

.hotel-table th, .hotel-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.hotel-table th {
    background-color: #444;
    color: #fff;
}

.hotel-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.hotel-table tr:hover {
    background-color: #ddd;
}

</style>
<body>
    <a class="logout-button" href="logout.php">Logout</a>
    <div class="sidebar">
    <button class="nav-button" id="Home">Home</button>
        <button class="nav-button" id="Hotels">Hotels</button>
        <button class="nav-button" id="users">Users</button>
        <button class="nav-button" id="rooms">Rooms</button>
        <button class="nav-button" id="bookings">Booking Details</button>
    </div>
    <div class="content">
        <div id="content-display">Hello Admin</div>
    </div>


<script>

    const contentDisplay = document.getElementById("content-display");

    document.getElementById("Home").addEventListener("click", () => {
        // Example: You can make an AJAX request to fetch data from the server here
        fetchHomeData();
    });

    document.getElementById("Hotels").addEventListener("click", () => {
        // Example: You can make an AJAX request to fetch hotel data from the server here
        fetchHotelData();
    });

    document.getElementById("users").addEventListener("click", () => {
        // Example: You can make an AJAX request to fetch user data from the server here
        fetchUserData();
    });

    document.getElementById("rooms").addEventListener("click", () => {
        // Example: You can make an AJAX request to fetch room data from the server here
        fetchRoomData();
    });

    document.getElementById("bookings").addEventListener("click", () => {
        // Example: You can make an AJAX request to fetch booking data from the server here
        fetchBookingData();
    });

    // Function to fetch and display home data using AJAX
    function fetchHomeData() {
        // Make an AJAX request to the server to fetch data and display it in contentDisplay
        // Example: You can use the fetch API or another AJAX method here.
        contentDisplay.textContent = "Hello Admin";
    }

    // Function to fetch and display hotel data using AJAX
    function fetchHotelData() {
    // Make an AJAX request to the server to fetch hotel data
    fetch('hotelsdisplay.php', {
        method: 'GET', // or 'POST' if you need to send data to the server
    })
    .then(response => response.json()) // Assuming the server returns JSON data
    .then(data => {
        // Create a table
        const table = document.createElement('table');
        table.classList.add('hotel-table');

        // Create table headers
        const headers = ['hotel_name', 'location', 'check_in_time', 'check_out_time', 'total_rooms', 'phone_number', 'address'];
        const headerRow = document.createElement('tr');
        headers.forEach(headerText => {
            const th = document.createElement('th');
            th.textContent = headerText;
            headerRow.appendChild(th);
        });
        table.appendChild(headerRow);

        // Loop through the data and create table rows
        data.forEach(rowData => {
            const row = document.createElement('tr');
            headers.forEach(header => {
                const cell = document.createElement('td');
                cell.textContent = rowData[header];

                row.appendChild(cell);
            });
            table.appendChild(row);
        });

        // Append the table to contentDisplay
        contentDisplay.innerHTML = '';
        contentDisplay.appendChild(table);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


function fetchUserData() {
    // Make an AJAX request to the server to fetch hotel data
    fetch('usersdisplay.php', {
        method: 'GET', // or 'POST' if you need to send data to the server
    })
    .then(response => response.json()) // Assuming the server returns JSON data
    .then(data => {
        // Create a table
        const table = document.createElement('table');
        table.classList.add('hotel-table');

        // Create table headers
        const headers = ['first_name', 'last_name', 'contact_no', 'email'];
        const headerRow = document.createElement('tr');
        headers.forEach(headerText => {
            const th = document.createElement('th');
            th.textContent = headerText;
            headerRow.appendChild(th);
        });
        table.appendChild(headerRow);

        // Loop through the data and create table rows
        data.forEach(rowData => {
            const row = document.createElement('tr');
            headers.forEach(header => {
                const cell = document.createElement('td');
                cell.textContent = rowData[header];

                row.appendChild(cell);
            });
            table.appendChild(row);
        });

        // Append the table to contentDisplay
        contentDisplay.innerHTML = '';
        contentDisplay.appendChild(table);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function fetchBookingData() {
     // Make an AJAX request to the server to fetch hotel data
     fetch('bookingdisplay.php', {
        method: 'GET', // or 'POST' if you need to send data to the server
    })
    .then(response => response.json()) // Assuming the server returns JSON data
    .then(data => {
        // Create a table
        const table = document.createElement('table');
        table.classList.add('hotel-table');

        // Create table headers
        const headers = ['check_in_date', 'check_out_date','adults','children','total_price','first_name','last_name','hotel_name','room_type'];
        const headerRow = document.createElement('tr');
        headers.forEach(headerText => {
            const th = document.createElement('th');
            th.textContent = headerText;
            headerRow.appendChild(th);
        });
        table.appendChild(headerRow);

        // Loop through the data and create table rows
        data.forEach(rowData => {
            const row = document.createElement('tr');
            headers.forEach(header => {
                const cell = document.createElement('td');
                cell.textContent = rowData[header];

                row.appendChild(cell);
            });
            table.appendChild(row);
        });

        // Append the table to contentDisplay
        contentDisplay.innerHTML = '';
        contentDisplay.appendChild(table);
    })
    .catch(error => {
        console.error('Error:', error);
    });
    

}

function fetchRoomData() {
    // Make an AJAX request to the server to fetch hotel data
    fetch('roomsdisplay.php', {
        method: 'GET', // or 'POST' if you need to send data to the server
    })
    .then(response => response.json()) // Assuming the server returns JSON data
    .then(data => {
        // Create a table
        const table = document.createElement('table');
        table.classList.add('hotel-table');

        // Create table headers
        const headers = ['room_id','hotel_id','room_type', 'capacity','price','available'];
        const headerRow = document.createElement('tr');
        headers.forEach(headerText => {
            const th = document.createElement('th');
            th.textContent = headerText;
            headerRow.appendChild(th);
        });
        table.appendChild(headerRow);

        // Loop through the data and create table rows
        data.forEach(rowData => {
            const row = document.createElement('tr');
            headers.forEach(header => {
                const cell = document.createElement('td');
                cell.textContent = rowData[header];

                row.appendChild(cell);
            });
            table.appendChild(row);
        });

        // Append the table to contentDisplay
        contentDisplay.innerHTML = '';
        contentDisplay.appendChild(table);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}




</script>
</body>
</html>
