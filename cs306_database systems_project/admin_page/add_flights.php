<?php
include "config.php";

if ( isset($_POST['id']) )
{
	$id = $_POST['id'];
	$time = $_POST['time'];
	$date = $_POST['date'];
	$arrival = $_POST['arrival'];
	$place = $_POST['place'];
	$destination = $_POST['destination'];
	$line = $_POST['line'];

	$sql_statement = "INSERT INTO flights (fid, take_off_date, take_off_time, arrival_time, take_off_place, destination, lineID)
						VALUES ('$id', '$time', '$date', '$arrival', '$place', '$destination', '$line')";

	$result = mysqli_query($db, $sql_statement);

	header ("Location: admin_flights.php");
	
}
else
{
	echo "The form is not yet set.";
}
?>