<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Mooli&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .login-container h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group input[type="submit"] {
            background-color: blue;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: lightskyblue;
        }

        .custom-alert{
            position: fixed;
            top:25px;
            right: 25px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Admin Panel Login</h2>
        <form action="authenticate.php" method="POST">
          <div class = "form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="admin_name" required><br><br>
          </div>
          <div class = "form-group">
               <label for="password">Password:</label>
               <input type="password" id="password" name="admin_pass" required><br><br>
         </div>
        <div class="form-group"> <input type="submit" value="Login"></div>
        
    </form>
</body>
</html>
