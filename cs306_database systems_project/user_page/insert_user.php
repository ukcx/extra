<!DOCTYPE html>
<html>
<head>
	<title>REGISTER</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
include "config.php";

if ( isset($_POST['name']) )
{
	$id = $_POST['id'];
	$sql_id_check = "SELECT * from passengers where pid = '$id'";
	$res_check = mysqli_query($db, $sql_id_check);
	$row = mysqli_fetch_assoc($res_check);

	if(($id == "0") || ($id == ""))
	{
		echo "<p style='color:black; font-family:verdana; font-size=300%'>ID number can not be null or 0!!</p>". "<br><br>";
		echo "<form action='user_register.php' method='POST'><button class='button_red'>GO BACK TO THE PREVIOUS PAGE</button></form><br><br>";
	}
	else if ((mysqli_num_rows($res_check) != 0))
	{
		echo "<p style='color:black; font-family:verdana; font-size=300%'>Invalid ID! A person with this ID has already been registered!</p>" . "<br><br>";
		echo "<form action='user_register.php' method='POST'><button class='button_red'>GO BACK TO THE PREVIOUS PAGE</button></form><br><br>";
	}
	else
	{
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];

		$sql_statement = "INSERT INTO passengers (pid, full_name, phone, email)
						VALUES ('$id', '$name', '$phone', '$email')";

		$result = mysqli_query($db, $sql_statement);

		header ("Location: success.php");
	}
	
}
else
{
	echo "The form is not set.";
}

?>

</body>
</html>