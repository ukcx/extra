<!DOCTYPE html>
<html>
<head>
	<title>USER REGISTRATION PAGE</title>
	<link rel="stylesheet" href="./styles.css">
</head>
<body>
<br>
<center>
<h1>USER REGISTER</h1><br><br>
<form action="insert_user.php" method="POST">
	<textarea name="id" rows="4" cols="60" placeholder="TYPE YOUR ID NUMBER HERE"></textarea><br>
	<textarea name="name" rows="4" cols="60" placeholder="TYPE YOUR FULL NAME HERE"></textarea><br>
	<textarea name="phone" rows="4" cols="60" placeholder="TYPE YOUR PHONE NUMBER HERE"></textarea><br>
	<textarea name="email" rows="4" cols="60" placeholder="TYPE YOUR E-MAIL HERE"></textarea><br><br>
	<button>REGISTER</button>
</form>
<br><br><br>
<form action='userpage.php' method='POST'>
	<button class="button_green">GO BACK TO THE MAIN PAGE</button>
</form><br><br>
</center>

</body>
</html>