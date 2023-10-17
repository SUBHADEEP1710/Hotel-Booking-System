<?php
if (isset($_POST["login-email"]) && isset($_POST["login-password"])) {
    $email = $_POST["login-email"];
    $password = $_POST["login-password"];
    
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'hotel_booking';
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
                    $plain_password = $row['password'];
                    if ($password == $plain_password) {
                        // Password is correct, user is authenticated
                                session_start();
                                $_SESSION['user_id'] = $row['user_id'];
                                header("Location: landing_page.html");
                                exit();}
                    else {
                            echo "Incorrect Password";
                        }
                    }
        else {
            echo "User not found. Please sign up.";
             }
    } 
    else {
        echo "Something went wrong";
        }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
 else {
    header("Location: index3.html"); // Redirect back to the login/signup page if form data is missing
    }
?>




