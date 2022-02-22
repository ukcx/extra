<!DOCTYPE html>
<html>
<head>
	<title>BOOK THIS SEAT</title>
	<link rel="stylesheet" href="styles.css">
	<style>
		body {
  background-image: url('./gifs/plane.gif');
  background-size: cover;
}
	</style>
</head>
<body>
<?php
if(isset($_POST['pid']))
{
	include "config.php";
	$pid = $_POST['pid'];
	$id = $_POST['id'];
	$seat_no = $_POST['sno'];
	$class = $_POST['class'];

	$sql_seat_check = "SELECT * from tickets where seat_no = '$seat_no' and flight_id = '$id'";
	$res_check = mysqli_query($db, $sql_seat_check);
	$row = mysqli_fetch_assoc($res_check);

	if ((mysqli_num_rows($res_check) != 0) || ($id == "0"))
	{
		echo "<br><p>This Seat has already been booked!</p>" . "<br><br>";
		echo "<form action='findtheseat.php' method='POST'><input type='hidden' name='pid' value='$pid'><input type='hidden' name='class' value='$class'><input type='hidden' name='id' value='$id'><button class='button_red'>GO BACK TO the PREVIOUS PAGE TO FIND ANOTHER SEAT</button></form><br><br>";
	}

	else
	{
		$sql_command = "SELECT price FROM tickets where flight_id = '$id' and class = '$class'";
		$myresult = mysqli_query($db, $sql_command);
		$pr = mysqli_fetch_assoc($myresult);
		$price = implode("|", $pr);
		
		$tid_0 = uniqid();
		$tid = substr($tid_0, 0, 10);
		
		$sql_id_check = "SELECT * from tickets where tid = '$tid'";
		$res_id_check = mysqli_query($db, $sql_id_check);
		$row = mysqli_fetch_assoc($res_id_check);

		while (mysqli_num_rows($res_check) != 0)
		{
			$tid_0 = uniqid();
			$tid = substr($tid_0, 0, 10);
			$sql_id_check = "SELECT * from tickets where tid = '$tid'";
			$res_id_check = mysqli_query($db, $sql_id_check);
			$row = mysqli_fetch_assoc($res_id_check);
		}

		$sql_statement = "INSERT INTO tickets (tid, class, seat_no, price, flight_id, passenger_id) 
			VALUES ('$tid', '$class', '$seat_no', '$price', '$id', '$pid')";

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
