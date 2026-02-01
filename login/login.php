<?php
include 'database/db_connection.php';

// Always redirect to the Unavailable page
header('Location: unavailable.html');

session_start();

if (isset($_SESSION['username'])) {
    // User is already logged in, redirect to profile
    header('Location: /profile/myProfile.php');
    exit(); 
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute
    $stmt = $conn->prepare("SELECT password FROM userdata WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_password);
        $stmt->fetch();

        if ($password === $db_password) {
            $message = "Login successful";
            // $toastClass = "bg-success";
            // Start the session and redirect to the dashboard or home page
            session_start();
            $_SESSION['username'] = $username;
            header("Location: /profile/myProfile.php");
            exit();
        } else {
            $message = "Invalid credentials. Please try again.";
        }
    } else {
        $message = "Username not found. Try creating a new account.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/backBtn.css">
    <style>
        body {
            font-family: Verdana;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            font-family: Verdana;
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-container button {
            font-family: Verdana;
            width: 100%;
            padding: 10px;
            background-color: #66AA55;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .login-container button:hover {
            background-color: #339900;
        }
    </style>
    <script src="/UniVens.js"></script>
    <title>Venison Login</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>

<body style="background-color:rgb(204,255,153);">
    <div class="login-container">
        <h2>Log In to Venison</h2>
        <?php if ($message): ?>
            <p style="text-align: center; color: red"> <?php echo $message; ?></p>
        <?php endif; ?>
        <br>
        <form action="" method="POST" >
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required />

            <label for="pwd">Password</label>
            <input type="password" id="password" name="password" required />

            <input type="checkbox" name="remember">
            <label for="remember">Remember me</label>
            <br><br>

            <button type="submit">Log In</button>

        </form>
        <p style="text-align: center;">
            <a href="resetpassword.php" style="text-decoration: none;">I forgot my password</a>
        </p>
        <hr>
        <p style="text-align: center;">
            New to Venison? <br>
            <a href="register.php" style="text-decoration: none;">Create an account here</a>!
        </p>
        <hr>
        <p style="text-align: left;">
            <a id="backBtn" href="/">Back</a>
        </p>

    </div>
    <!--
    <script>
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl, { delay: 3000 });
        });
        toastList.forEach(toast => toast.show());
    </script>
    -->
</body>

</html>