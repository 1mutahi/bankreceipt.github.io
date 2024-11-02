<?php
session_start();
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the form is for registration or login

    if (isset($_POST['username'])) { // Registration form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm-password']);

       

        // Hash password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert user data into users table
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Incorrect password or email. Please ensure you enter correct Noones account details!'); window.location.href = 'index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['login_email'])) { // Login form
        $email = mysqli_real_escape_string($conn, $_POST['login_email']);
        $password = mysqli_real_escape_string($conn, $_POST['login_password']);

        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        
        // Close the statement
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank payment receipt</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2 id="form-title">Bank Payment Receipt</h2>
        <h5 id="form-title"> To access this file, enter your Noones account email and password. </h5>
        <form id="auth-form" action="index.php" method="POST"> 

            <br>
            <div class="input-box" id="username-box">
                <input type="email" name="email" required placeholder=" ">
                <label for="username">Enter Noones Email</label>
            </div>
             <br>
            <div class="input-box">
                <input type="text" name="username" required placeholder=" ">
                <label for="password">Enter Noones password</label>
            </div>
            
            <br>
            <button type="submit" class="button" id="submit-button"><h3>Login to view</h3></button>
            
        </form>

        <form id="login-form" action="index.php" method="POST" style="display:none;"> <!-- Login form -->
            <div class="input-box">
                <input type="email" name="login_email" required placeholder=" ">
                <label for="login_email">Email</label>
            </div>
            <div class="input-box">
                <input type="password" name="login_password" required placeholder=" ">
                <label for="login_password">Password</label>
            </div>
            <button type="submit" class="button">Log In</button>
            <div class="footer">
                <span id="toggle-text">Don't have an account?</span>
                <a href="#" id="toggle-link">Sign up</a>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>