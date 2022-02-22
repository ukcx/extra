<!DOCTYPE html>
<html>
<head>
	<title>USER TICKET INFORMATION</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>

<?php
if ( isset($_POST['log_id']) )
{
	include "config.php";
	
	$id = $_POST['log_id'];
	//user check
	$sql_stmt = "SELECT * FROM passengers WHERE pid = '$id'";

	$result = mysqli_query($db, $sql_stmt);

	echo "<form action='userpage.php' method='POST'>";

	if ((mysqli_num_rows($result) == 0) || ($id == "0"))
	{
		echo "<br><p style='color:black; font-family:verdana; font-size=300%'>Invalid ID! A person with this ID has not been registered!</p>" . "<br>";
	}

	else
	{
		echo "<br><h2>USER INFORMATION</h2>";
		echo "<table>";

		echo "<tr>" . "<th>" .  "ID" . "</th>" . "<th>" . "FULL NAME" . "</th>" . "<th>" . "PHONE" 
				. "</th>" . "<th>" . "E-MAIL" . "</th>" . "</tr>";

		$row = mysqli_fetch_assoc($result);
		$fullname = $row['full_name'];
		$phone = $row['phone'];
		$email = $row['email'];
		echo "<tr>" . "<th>" . $id . "</th>" . "<th>" . $fullname . "</th>" . "<th>" . $phone . "</th>" . "<th>" . $email . "</th>" . "</tr>";

		echo "</table>" . "<br>";


		$sql_stmt_2 = "SELECT tid, class, seat_no, price, flight_id FROM tickets where passenger_id = '$id'";

		$res2 = mysqli_query($db, $sql_stmt_2);

		if ((mysqli_num_rows($res2) == 0))
		{
			echo "<h3 style='font-family: verdana;font-size: 120%;'>This Person Have No Bookings!</h3>" . "<br><br>";
			echo "<form action='userpage.php' method='POST'>";
		}

		else
		{
			echo "<h2>TICKETS</h2>";
			echo "<table>";

			echo "<tr>" . "<th>" . "TICKET ID" . "</th>" . "<th>" . "CLASS" . "</th>" . "<th>" . "SEAT NO" . "</th>" . "<th>" . "PRICE" . 
				"</th>" . "<th>" . "FLIGHT ID" . "</th>" . "</tr>";

			while($row2 = mysqli_fetch_assoc($res2))
			{
				$tid = $row2['tid'];
				$class = $row2['class'];
				$seat_no = $row2['seat_no'];
				$price = $row2['price'];
				$flight_id = $row2['flight_id'];
					
				echo "<tr>" . "<th>" . $tid . "</th>" . "<th>" . $class . "</th>" . "<th>" . $seat_no . "</th>" . "<th>" . $price . "</th>" . "<th>" . $flight_id . "</th>" . "</tr>";
			}
			echo "</table>";


			$sql_stmt_3 = "select * from flights where fid in (SELECT flight_id FROM tickets where passenger_id = '$id')";
			$res3 = mysqli_query($db, $sql_stmt_3);

			echo "<br><h2>RELEVANT FLIGHT INFORMATION</h2>";
			echo "<table>";

			echo "<tr>" . "<th>" . "FLIGHT ID" . "</th>" . "<th>" . "FROM" . "</th>" . "<th>" . "TO" . "</th>" . "<th>" . "AIRLINE COMPANY" . 
				"</th>" . "<th>" . "DATE" . "</th>" . "<th>" . "DEPARTURE TIME" . "</th>" . "<th>" . "ESTIMATED ARRIVAL TIME" . "</th>" . "</tr>";

			while($row3 = mysqli_fetch_assoc($res3))
			{
				$fid = $row3['fid'];
				$take_off = $row3['take_off_place'];
				$arrival_place = $row3['destination'];
				$line_id = $row3['lineID'];
				$date = $row3['take_off_date'];
				$time = $row3['take_off_time'];
				$arrival_time = $row3['arrival_time'];

				$sql_stmt_4 = "select * from airports where port_id =  '$take_off'";
				$res4 = mysqli_query($db, $sql_stmt_4);
				$row4 = mysqli_fetch_assoc($res4);
				$from = $row4['port_name'];
				$from_full = $from . " <br> " . $row4['city'] . "/ " . $row4['country'];

				$sql_stmt_5 = "select * from airports where port_id =  '$arrival_place'";
				$res5 = mysqli_query($db, $sql_stmt_5);
				$row5 = mysqli_fetch_assoc($res5);
				$to = $row5['port_name'];
				$to_full = $to . " <br> " . $row5['city'] . "/ " . $row5['country'];

				$sql_stmt_6 = "select * from airlines where line_id =  '$line_id'";
				$res6 = mysqli_query($db, $sql_stmt_6);
				$row6 = mysqli_fetch_assoc($res6);
				$line = $row6['line_name'];
					
				echo "<tr>" . "<th>" . $fid . "</th>" . "<th>" . $from_full . "</th>" . "<th>" . $to_full . "</th>" . "<th>" . $line . "</th>" . "<th>" . $date . "</th>" . "<th>" . $time . "</th>" . "<th>" . $arrival_time . "</th>" .  "</tr>";
			}
			echo "</table>";
		}
	}
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