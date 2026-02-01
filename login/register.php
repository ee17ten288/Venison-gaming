<?php
include 'database/db_connection.php';

// Always redirect to the Unavailable page
header('Location: unavailable.html');

session_start();

if (isset($_SESSION['username'])) {
    // User is already registered, redirect to profile
    header('Location: /profile/myProfile.php');
    exit();
}

$message = "";
$toastClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password-confirm'];
    $birthDate = $_POST['birthdate'];

    // Check if email already exists
    $checkEmailStmt = $conn->prepare("SELECT email FROM userdata WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    // Check if username already exists
    $checkUserStmt = $conn->prepare("SELECT username FROM userdata WHERE username = ?");
    $checkUserStmt->bind_param("s", $username);
    $checkUserStmt->execute();
    $checkUserStmt->store_result();

    // Do NOT check if user is 13+ years of age, this is forced in the form

    if ($password !== $password_confirm) {
        $message = "Passwords do not match";
        $toastClass = "#ff2400"; // Primary color
    } elseif ($checkEmailStmt->num_rows > 0) { 
        $message = "An account with that email already exists.";
        $toastClass = "#ff2400"; // Primary color
    } elseif ($checkUserStmt->num_rows > 0) { 
        $message = "An account with the username \"".$username."\" already exists";
        $toastClass = "#ff2400"; // Primary color
    } elseif (true){ // do this instead of execution
        $message = "Register successful";
        $toastClass = "#00cc33";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO userdata (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $message = "Account created successfully";
            $toastClass = "#00cc33"; // Success color
            // Start the session immediately upon account creation
            session_start();
            $_SESSION['username'] = $username;
            header("Location: /profile/myProfile.php");
            exit();
        } else {
            $message = "Error: " . $stmt->error;
            $toastClass = "#ff2400"; // Danger color
        }

        $stmt->close();
    }

    $checkEmailStmt->close();
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

        .reg-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 480px;
        }

        .reg-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .reg-container input[type="text"],
        .reg-container input[type="password"],
        .reg-container input[type="email"],
        .reg-container input[type="date"]{
            font-family: Verdana;
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .reg-container button {
            font-family: Verdana;
            width: 100%;
            padding: 10px;
            background-color: #66AA55;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .reg-container button:hover {
            background-color: #339900;
        }
    </style>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">-->
    <!--<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/295/295128.png">-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>-->
    <script src="/UniVens.js"></script>
    <script>
        function validatePwd(){
            var pass = document.getElementById("password").value;
            var pass_conf = document.getElementById("password-confirm").value;
            if (pass != pass_conf) {
                alert("Passwords do not match")
               //document.getElementById('errorMsg').style.color = "#ff2400"
               //document.getElementById('errorMsg').innerHTML = "Passwords do not match"
               return false;
            }
            return true;
        }
    </script>
    <title>Venison Registration</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>

<body style="background-color:rgb(204,255,153);">
    <div class="reg-container">
        <h2>Join the Venison Community</h2>
        <?php if ($message): ?>
            <p id="errorMsg" style="text-align: center; color: <?php echo $toastClass; ?>"> <?php echo $message; ?></p>
        <?php endif; ?>
        <br>
        <form action="" onsubmit="return validatePwd()" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" minlength="6" maxlength="36" required />

            <label for="email">E-Mail Address</label>
            <input type="email" id="email" name="email" required />

            <label for="password">Password</label>
            <input type="password" id="password" name="password" minlength="6" required />

            <label for="password-confirm">Confirm Password</label>
            <input type="password" id="password-confirm" name="password-confirm" required />

            <label for="birthdate">Date of Birth</label>
            <input type="date" id="birthdate" name="birthdate" min="1900-01-01" required><br><br>
            <script> // sets max date to 13 years before today
                const dateInput = document.getElementById('birthdate');
                const today = new Date();
                const year = today.getFullYear() - 13;
                const month = String(today.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
                const day = String(today.getDate()).padStart(2, '0');
                const formattedToday = `${year}-${month}-${day}`;

                // Set the max attribute of the input to today's date
                dateInput.setAttribute('max', formattedToday);
            </script>

            <p style="text-align: center;">
                By clicking on the checkbox below, you certify that you are at least 13 years of age and you agree to the terms listed in the
                <a href="#">Venison User Agreement</a>.
            </p>

            <input type="checkbox" name="user-agreement" required>
            <label for="user-agreement">I agree</label>
            <br><br>

            <button type="submit">Create Account</button>
        </form>
        <hr>
        <p style="text-align: center;">
            Already have an account? <br>
            <a href="login.php" style="text-decoration: none;">Sign in here</a>!
        </p>
        <hr>
        <p style="text-align: left;">
            <a id="backBtn" href="/">Back</a>
        </p>
    </div>
    <!--<script>
        let toastElList = [].slice.call(document.querySelectorAll('.toast'))
        let toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl, { delay: 3000 });
        });
        toastList.forEach(toast => toast.show());
    </script>-->
</body>

</html>