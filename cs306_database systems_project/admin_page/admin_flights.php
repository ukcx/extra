<!DOCTYPE html>
<html>
<head>
	<title>FLIGHTS ADMIN PAGE</title>
</head>
<style>

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
<body>
<div align=CENTER>
<br>
<b>WELCOME TO THE ADMIN PAGE OF THE FLIGHTS TABLE</b>
<br><br><br>
</div>
<div>
<b>THE CURRENT STATE OF THE FLIGHTS TABLE: </b>
<br><br>
</div>
<div align=CENTER>
<table>

<tr><th> ID </th><th> DATE </th><th> TIME </th><th> ARRIVAL TIME </th><th> DEPARTURE AIRPORT ID</th><th> DESTINATION AIRPORT ID</th>
	<th> AIRLINE ID </th></tr>

<?php

include "config.php";

$sql_statement = "SELECT * FROM flights";

$result = mysqli_query($db, $sql_statement);

while($row = mysqli_fetch_assoc($result)){

	$id = $row['fid'];
	$date = $row['take_off_date'];
	$time = $row['take_off_time'];
	$arrival = $row['arrival_time'];
	$place = $row['take_off_place'];
	$destination = $row['destination'];
	$line = $row['lineID'];
	echo "<tr>" . "<th>" . $id . "</th>" . "<th>" . $date . "</th>" . "<th>" . $time . "</th>" . "<th>" . $arrival . "</th>" . 
				"<th>" . $place . "</th>" . "<th>" . $destination . "</th>" . "<th>" . $line . "</th>" . "</tr>";
}

?>

</table>
<br>
</div>


<div>
<b>TO INSERT A NEW FLIGHT TO THE DATABASE USE THE FORM BELOW: </b>
<br><br>
<form action="add_flights.php" method="POST">
	<textarea name="id" rows="3" cols="60" placeholder="Type your FLIGHT ID here!"></textarea><br>
	<textarea name="time" rows="3" cols="60" placeholder="Type the DATE OF THE FLIGHT here! (YYYY-MM-DD) "></textarea><br>
	<textarea name="date" rows="3" cols="60" placeholder="Type the TIME OF THE FLIGHT here in (HH:MM:SS) format! RANGE FROM (00:00:00) TO (23:59:59) "></textarea><br>
	<textarea name="arrival" rows="3" cols="60" placeholder="Type the ARRIVAL TIME OF THE FLIGHT here in (HH:MM:SS) format! RANGE FROM (00:00:00) TO (23:59:59) "></textarea><br><br>

	<b>Select the AIRPORT'S ID THAT THE FLIGHT TAKES OFF FROM here</b>
	<select name="place">
	<?php
		$sql_command = "SELECT port_id FROM airports";
		$myresult = mysqli_query($db, $sql_command);
		while($id_rows = mysqli_fetch_assoc($myresult))
		{
			$id = $id_rows['port_id'];
					echo "<option value=$id>".$id."</option>";
		}
	?>
	</select><br><br>

	<b>Select the AIRPORT'S ID THAT THE FLIGHT ARRIVES TO here</b>
	<select name="destination">
	<?php
		$sql_command = "SELECT port_id FROM airports";
		$myresult = mysqli_query($db, $sql_command);
		while($id_rows = mysqli_fetch_assoc($myresult))
		{
			$id = $id_rows['port_id'];
					echo "<option value=$id>".$id."</option>";
		}
	?>
	</select><br><br>

	<b>Select the AIRLINE ID OF THE FLIGHT here</b>
	<select name="line">
	<?php
		$sql_command = "SELECT line_id FROM airlines";
		$myresult = mysqli_query($db, $sql_command);
		while($id_rows = mysqli_fetch_assoc($myresult))
		{
			$id = $id_rows['line_id'];
					echo "<option value=$id>".$id."</option>";
		}
	?>
	</select><br><br>
	<button>INSERT</button>
</form>

<br><br>

<b>TO DELETE AN EXISTING FLIGHT FROM THE DATABASE USE THE OPTION BUTTON BELOW TO SELECT THE ID OF THE FLIGHT TO BE DELETED: </b>
<br><br>
<form action="delete_flights.php" method="POST">
<select name="ids">

<?php
	$sql_command = "SELECT fid FROM flights";
	$myresult = mysqli_query($db, $sql_command);
	while($id_rows = mysqli_fetch_assoc($myresult))
	{
		$id = $id_rows['fid'];
				echo "<option value=$id>".$id."</option>";
	}
?>
</select>
<button>DELETE</button>
</form>
<br><br>

<b>TO SEARCH THE REQUIRED ROWS AND COLUMNS FROM THE TABLE: </b>
<br><br>
<form action="search_flights.php" method="POST">
<b>SELECT </b>
<select name="select_clmn">
<?php
	$sql_com = "SHOW columns FROM flights";
	$myres = mysqli_query($db, $sql_com);
	while($row = mysqli_fetch_assoc($myres))
	{
		$clmn = $row['Field'];
		echo "<option value=$clmn>".$clmn."</option>";
	}
	$clmn = "*";
	echo "<option value=$clmn>". $clmn ."</option>";
?>
</select>
<br><br>
<b>FROM flights F</b>
<br><br>
<b>WHERE F.</b>
<select name="where_clmn">
<?php
	$sql_com = "SHOW columns FROM flights";
	$myres = mysqli_query($db, $sql_com);
	while($row = mysqli_fetch_assoc($myres))
	{
		$clmn = $row['Field'];
		echo "<option value=$clmn>".$clmn."</option>";
	}
?>
</select>
<b> = </b>
<input type="text" name="query_clmn"><br><br>
<button>SEARCH</button>
</form>
</div>
</body>
</html>