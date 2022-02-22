<?php
include "config.php";

if ( isset($_POST['id']) )
{
	$id = $_POST['id'];
	$class = $_POST['class'];
	$seatNo = $_POST['seat_no'];
	$price = $_POST['price'];
	$flightId = $_POST['flight_id'];
	$passengerId = $_POST['passenger_id'];

	$sql_statement = "INSERT INTO tickets (tid, class, seat_no, price, flight_id, passenger_id)
						VALUES ('$id', '$class', '$seatNo', '$price', '$flightId', '$passengerId')";

	$result = mysqli_query($db, $sql_statement);

	header ("Location: admin_tickets.php");
	
}
else
{
	echo "The form is not yet set.";
}
?>