<!DOCTYPE html>
<html>
<head>
	<title>FIND FLIGHTS</title>
	<link rel="stylesheet" href="styles.css">
	<style>
		body {
  background-image: url('./gifs/plane.gif');
  background-size: cover;
}
	</style>
</head>
<body>
<table>
<?php
include "config.php";

if (isset($_POST['date']))
{

	$from = $_POST['from'];
	$to = $_POST['to'];
	$date = $_POST['date'];
	$pid = $_POST['pid'];


	$sql_stmt = "SELECT fid, take_off_time, line_name, arrival_time FROM flights, airlines
				WHERE flights.take_off_place IN (select port_id from airports where city = '$from') 
				and flights.destination IN (select port_id from airports where city = '$to')
                and flights.take_off_date = '$date'
                and flights.lineID = airlines.line_id
                order by take_off_time";

	$result = mysqli_query($db, $sql_stmt);

	if((mysqli_num_rows($result) == 0))
	{
		echo "<br><p>THERE IS NO FLIGHT ON THIS DAY from " . "$from" . " to " . "$to</p>";
	}
	else
	{
		echo "<br><p>	THE AVAILABLE FLIGHTS from	$from to $to on $date	</p><br><br>";
		echo "<tr>" . "<th>" . "FLIGHT ID" . "</th>" . "<th>" . "DEPARTURE TIME" . "</th>" . "<th>" . "ESTIMATED ARRIVAL TIME" . "</th>" . "<th>" . "AIRLINE COMPANY" . "</th>" . "<th>" . "PRICE ECONOMY" . "</th>" .  "<th>" . "PRICE BUSINESS" . "</th>" . "<th>" .  "BOOK FROM THIS FLIGHT" . "</th>" . "</tr>";
	
		while($row = mysqli_fetch_assoc($result))
		{

			$id = $row['fid'];
			$time = $row['take_off_time'];
			$arrival = $row['arrival_time'];
			$line = $row['line_name'];
			
			$sql2 = "SELECT class, price from tickets where flight_id = '$id'";
			$res2 = mysqli_query($db, $sql2);
			while($row2 = mysqli_fetch_assoc($res2))
			{
				$class = $row2['class'];
				if($class == "economy")
				{
					$eco_price = $row2['price'];
				}
				if($class == "business")
				{
					$buss_price = $row2['price'];
				}
			}

			echo "<tr>" . "<th>" . $id . "</th>" . "<th>" . $time . "</th>". "<th>" . $arrival . "</th>" . "<th>" . $line . "</th>" . "<th>" . $eco_price . "</th>" . "<th>" . $buss_price . "</th>" . "<th>" . "<form method='post' action='findtheseat.php'><input type='hidden' name='pid' value='$pid'><input type='hidden' name='id' value='$id'><input type='hidden' name='class' value='economy'><input type='submit' name='action' value='economy'></form><form method='post' action='findtheseat.php'><input type='hidden' name='pid' value='$pid'><input type='hidden' name='id' value='$id'><input type='hidden' name='class' value='business'><input type='submit' name='action' value='business'></form>" . 
				"</th>" . "</tr>";

		}
		echo "</table>";
	}
	echo "<br><br><form action='book_flights.php' method='POST'><input type='hidden' name='id' value='$pid'><button class='button_red'>GO BACK TO THE PREVIOUS PAGE</button></form><br><br>";
}

else
{
	echo "The form is not set.";
}

?>
</body>
</html>
