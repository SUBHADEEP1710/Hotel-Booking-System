<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login/Signup</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="header-logo">
                <img src="logo.png" alt="Wanderlust Logo">
            </div>

        </div>

    </header>
    <main>
        <section class="auth-section">
            <h2 id="auth-title">Are you a new user?</h2>
            <div class="auth-buttons">
                <button id="signup-button">Sign Up</button>
                <button id="login-button">Login</button>
            </div>
            <div id="signup-form" style="display: none;">
                <h2>Sign Up</h2>

                <form action="signup.php" method="POST">
                    <div class="input-group">
                        <label for="first-name">First Name:</label>
                        <input type="text" id="first-name" name="first-name" required>
                    </div>
                    <div class="input-group">
                        <label for="last-name">Last Name:</label>
                        <input type="text" id="last-name" name="last-name" required>
                    </div>
                    <div class="input-group">
                        <label for="contact-number">Contact Number:</label>
                        <input type="tel" id="contact-number" name="contact-number" required>
                    </div>
                    <div class="input-group">
                        <label for="signup-email">Email:</label>
                        <input type="email" id="signup-email" name="signup-email" required>
                    </div>
                    <div class="input-group">
                        <label for="signup-password">Password:</label>
                        <input type="password" id="signup-password" name="signup-password" required>
                    </div>

                    <button type="submit">Sign Up</button>
                </form>
            </div>
            <div id="login-form">
                <h2>Login</h2>
                <form action="login_user.php" method="POST">
                    <div class="input-group">
                        <label for="login-email">Email:</label>
                        <input type="email" id="login-email" name="login-email" required>
                    </div>
                    <div class="input-group">
                        <label for="login-password">Password:</label>
                        <input type="password" id="login-password" name="login-password" required>
                    </div>


                    <button type="submit">Login</button>
                </form>
            </div>
        </section>
    </main>



    <script>
        const signupButton = document.getElementById("signup-button");
        const loginButton = document.getElementById("login-button");
        const signupForm = document.getElementById("signup-form");
        const loginForm = document.getElementById("login-form");
        const authTitle = document.getElementById("auth-title");

        signupButton.addEventListener("click", function() {
            signupForm.style.display = "block";
            loginForm.style.display = "none";
            authTitle.textContent = "Create an account";
        });

        loginButton.addEventListener("click", function() {
            signupForm.style.display = "none";
            loginForm.style.display = "block";
            authTitle.textContent = "Welcome back!";
        });
    </script>



</body>

</html>