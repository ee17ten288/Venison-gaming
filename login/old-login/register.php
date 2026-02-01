<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <script src="/UniVens.js"></script>
    <title>Venison Registration</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body style="background-color:rgb(204,255,153);">
    <div class="reg-container">
        <h2>Register</h2>
        <form action="register-success.php" method="POST">
            <label for="uname">Username</label>
            <input type="text" id="uname" name="uname" required />

            <label for="email">E-Mail Address</label>
            <input type="email" id="email" name="email" required />

            <label for="pwd">Password</label>
            <input type="password" id="pwd" name="pwd" required />

            <label for="pwd-confirm">Confirm Password</label>
            <input type="password" id="pwd-confirm" name="pwd-confirm" required />

            <label for="birthdate">Date of Birth</label>
            <input type="date" id="birthdate" name="birthdate" max="2012-10-23" required><br><br>

            <button type="button" onclick="getBirthday()">Verify Age</button>
            <p id="ageCounter" style="text-align: center;">Enter your age</p>

            <p style="text-align: center;">
                By clicking on the checkbox below, you certify that you are at least 13 years of age and you agree to the terms listed in the
                <a href="#">Venison User Agreement</a>.
            </p>

            <input type="checkbox" name="user-agreement">
            <label for="user-agreement">I agree</label>
            <br><br>

            <button type="submit">Create Account</button>
        </form>
        <hr>
        <p style="text-align: center;">
            Already have an account? <br>
            <a href="login.html" style="text-decoration: none;">Sign in here</a>!
        </p>
    </div>
</body>
</html>