<?php
include "config.php";

if ( isset($_POST['id']) )
{
	$id = $_POST['id'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$sql_statement = "INSERT INTO passengers (pid, full_name, phone, email, p_type)
						VALUES ('$id', '$name', '$phone', '$email', '$type')";

	$result = mysqli_query($db, $sql_statement);

	header ("Location: admin_passengers.php");
	
}
else
{
	echo "The form is not yet set.";
}
?>
