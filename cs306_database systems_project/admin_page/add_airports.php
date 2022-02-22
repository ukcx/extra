<?php
include "config.php";

if ( isset($_POST['name']) )
{
	$name = $_POST['name'];
	$city = $_POST['city'];
	$country = $_POST['country'];

	$sql_statement = "INSERT INTO airports (port_name, city, country)
						VALUES ('$name', '$city', '$country')";

	$result = mysqli_query($db, $sql_statement);

	header ("Location: admin_airports.php");
	
}
else
{
	echo "The form is not yet set.";
}
?>