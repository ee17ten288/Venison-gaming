<html>
<head>
	<meta http-equiv="refresh" content="2; url=/error.html" /> <!-- auto redirect-->
</head>
<body>
	Welcome to Venison, <?php echo $_POST["uname"]; ?>!<br>
	
	Logging in as <?php echo $_POST["uname"]; ?>... <br><br>

	L: <?php echo $_SERVER["PHP_SELF"];?>
	H: <?php echo $_SERVER["HTTP_HOST"];?>
</body>
</html>