<!DOCTYPE html>
<html>
<head>
	<title>USER TICKET CANCEL PAGE</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
if ( isset($_POST['id']) )
{
	include "config.php";
	
	$pid = $_POST['id'];
	//user check
	$sql_stmt = "SELECT * FROM passengers WHERE pid = '$pid'";

	$result = mysqli_query($db, $sql_stmt);

	if ((mysqli_num_rows($result) == 0) || ($pid == "0") || ($pid == "") )
	{
		echo "<p style='color:black; font-family:verdana; font-size=300%'>Invalid ID! A person with this ID has not been registered!</p>" . "<br><br>";
		
	}

	else
	{
		echo "<h2>USER INFORMATION</h2>";
		echo "<table>";

		echo "<tr>" . "<th>" .  "ID" . "</th>" . "<th>" . "FULL NAME" . "</th>" . "<th>" . "PHONE" 
				. "</th>" . "<th>" . "E-MAIL" . "</th>" . "</tr>";

		$row = mysqli_fetch_assoc($result);
		$fullname = $row['full_name'];
		$phone = $row['phone'];
		$email = $row['email'];
		echo "<tr>" . "<th>" . $pid . "</th>" . "<th>" . $fullname . "</th>" . "<th>" . $phone . "</th>" . "<th>" . $email . "</th>" . "</tr>";

		echo "</table>" . "<br><br>";

		$sql_stmt_2 = "SELECT tid, class, seat_no, price, flight_id FROM tickets where passenger_id = '$pid'";

		$res2 = mysqli_query($db, $sql_stmt_2);

		if ((mysqli_num_rows($res2) == 0))
		{
			echo "<h3 style='font-family: verdana;font-size: 120%;'>This Person Have No Bookings!</h3>" . "<br><br>";
		}

		else
		{
			echo "<h2>TICKETS</h2>";
			echo "<table>";

			echo "<tr>" . "<th>" . "TICKET ID" . "</th>" . "<th>" . "CLASS" . "</th>" . "<th>" . "SEAT NO" . "</th>" . "<th>" . "PRICE" . "</th>" . "<th>" . "FLIGHT ID" . "</th>" . "<th>" . "</th>" . "</tr>";

			while($row2 = mysqli_fetch_assoc($res2))
			{
				$tid = $row2['tid'];
				$class = $row2['class'];
				$seat_no = $row2['seat_no'];
				$price = $row2['price'];
				$flight_id = $row2['flight_id'];
					
				echo "<tr>" . "<th>" . $tid . "</th>" . "<th>" . $class . "</th>" . "<th>" . $seat_no . "</th>" . "<th>" . $price . "</th>" . "<th>" . $flight_id . "</th>" . "<th>" ."<form method='post' action='delete_booking.php'><input type='hidden' name='pid' value='$pid'><input type='hidden' name='tid' value='$tid'><button class='button_red'>CANCEL THIS BOOKING</button></form>" . "</th>" . "</tr>";
			}

			echo "</table>";
		}

	}
	echo "<form action='userpage.php' method='POST'>";
	echo "<br><br><button class='button_green'>GO BACK TO THE MAIN PAGE</button></form><br><br>";
}
else
{
	echo "The form is not set.";
}
?>
</table>
</body>
</html>