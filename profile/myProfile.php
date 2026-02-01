<?php
session_start();

// Always redirect to the Unavailable page in the Login folder
header('Location: /login/unavailable.html');

// Check if the user is logged in, if
// not then redirect them to the login page
if (!isset($_SESSION['username'])) {
    header("Location: /login/login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <style>
        body {margin: 0;}

        ul.sidenav {
            list-style-type: none;
            font-family: verdana;
            margin: 0;
            padding: 0;
            width: 25%;
            background-color: #249315;
            position: fixed;
            height: 100%;
            overflow: auto;
        }

        ul.sidenav li a {
            display: block;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
        }
 
        ul.sidenav li a.active {
            background-color: #90f030;
            color: black;
        }

        ul.sidenav li a:hover:not(.active):not(.homelink) {
            background-color: #e4e432;
            color: black;
        }

        div.content {
            margin-left: 25%;
            padding: 1px 16px;
            height: 1000px;
        }

        @media screen and (max-width: 900px) {
            ul.sidenav {
                width: 90%;
                height: auto;
                position: relative;
            }
  
            ul.sidenav li a {
                float: left;
                padding: 15px;
            }

            #logoutBar {
                float: right;
            }
  
            div.content {margin-left: 0;}
        }
        @media screen and (max-width: 400px) {
            ul.sidenav li a {
                text-align: center;
                float: none;
            }
            #logoutBar {
                float: none;
            }
        }
    </style>
    <script src="/UniVens.js"></script>
    <title>My Profile</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>

<body style="background-color:rgb(204,255,153);">
    <nav class="profile-navbar">
        <ul class="sidenav">
            <li><a class="homelink" href="/"><img src="/Venison_Logo.png" style="width:75px; height:75px;vertical-align:middle" alt="Venison"></a></li>
            <li><a class="active" href="#" style="font-weight:bold;">Dashboard</a></li>
            <li><a href="#" style="font-weight:bold;">Settings</a></li>
            <li id="logoutBar"><a href="/login/logout.php" style="font-weight:bolder;color:red;">Logout</a></li>
        </ul>
    </nav>
    <div class="content">
        <div>
            <h1 style="text-align:center;">Welcome to <u><?php echo $username; ?>'s</u> Profile</h2>
        </div>
    </div>
</body>

</html>