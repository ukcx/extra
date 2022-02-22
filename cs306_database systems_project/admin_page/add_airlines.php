<?php
include "config.php";

if ( isset($_POST['name']) )
{
	$name = $_POST['name'];

	$sql_statement = "INSERT INTO airlines (line_name)
						VALUES ('$name')";

	$result = mysqli_query($db, $sql_statement);

	header ("Location: admin_airlines.php");
	
}
else
{
	echo "The form is not yet set.";
}
?>