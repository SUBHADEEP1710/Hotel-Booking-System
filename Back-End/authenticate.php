<?php
// Establish a database connection
$db_host = 'localhost';
$db_user = 'root';
$db_password ='';
$db_name = 'hotel_booking';
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$admin_name = $_POST['admin_name'];
$admin_pass = $_POST['admin_pass'];

// Query to check credentials with placeholders
$query = "SELECT * FROM admin_cred WHERE TRIM(admin_name)=? AND TRIM(admin_pass)=?";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    die("Preparation failed: " . mysqli_error($conn));
}

// Bind parameters
mysqli_stmt_bind_param($stmt, "ss", $admin_name, $admin_pass);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);


if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 1) {
    // Authentication successful
    session_start();
    $_SESSION['admin_name'] = $admin_name;
    header('Location: dashboard.php');
} else {
    // Authentication failed
    echo "<script>alert('Invalid credentials. Please try again.');</script>";
    echo "<script>window.location='login.php';</script>";
}


?>
