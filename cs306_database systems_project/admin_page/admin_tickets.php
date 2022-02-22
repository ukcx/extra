<!DOCTYPE html>
<html>
<head>
	<title>TICKETS ADMIN PAGE</title>
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
<b>WELCOME TO THE ADMIN PAGE OF THE TICKETS TABLE</b>
<br><br><br>
</div>
<div>
<b>THE CURRENT STATE OF THE TICKETS TABLE: </b>
<br><br>
</div>
<div align=CENTER>
<table>

<tr><th> ID </th><th> CLASS </th><th> SEAT NO </th><th> PRICE ($) </th><th> FLIGHT ID </th><th> PASSENGER ID </th></tr>

<?php

include "config.php";

$sql_statement = "SELECT * FROM tickets";

$result = mysqli_query($db, $sql_statement);

while($row = mysqli_fetch_assoc($result)){

	$id = $row['tid'];
	$class = $row['class'];
	$seat_no = $row['seat_no'];
	$price = $row['price'];
	$flight_id = $row['flight_id'];
	$passenger_id = $row['passenger_id'];
	echo "<tr>" . "<th>" . $id . "</th>" . "<th>" . $class . "</th>" . "<th>" . $seat_no . "</th>" . "<th>" . $price . "</th>" . 
				"<th>" . $flight_id . "</th>" ."<th>" . $passenger_id . "</th>" . "</tr>";
}

?>

</table>
<br>
</div>


<div>
<b>TO INSERT A NEW TICKETS TO THE DATABASE USE THE FORM BELOW: </b>
<br><br>
<form action="add_tickets.php" method="POST">
	<textarea name="id" rows="2" cols="50" placeholder="Type your TICKET ID here!"></textarea><br>
	<textarea name="class" rows="2" cols="50" placeholder="Type the CLASS OF THE TICKET here!"></textarea><br>
	<textarea name="seat_no" rows="2" cols="50" placeholder="Type the SEAT NUMBER OF THE TICKET here!"></textarea><br>
	<textarea name="price" rows="2" cols="50" placeholder="Type the PRICE OF THE TICKET here!"></textarea><br><br>

	<b>Select the FLIGHT'S ID here</b>
	<select name="flight_id">
	<?php
		$sql_command = "SELECT fid FROM flights";
		$myresult = mysqli_query($db, $sql_command);
		while($id_rows = mysqli_fetch_assoc($myresult))
		{
			$id = $id_rows['fid'];
					echo "<option value=$id>".$id."</option>";
		}
	?>
	</select><br><br>

	<b>Select the PASSENGER'S ID THAT THE TICKET BELONGS TO here</b>
	<select name="passenger_id">
	<?php
		$sql_command = "SELECT pid FROM passengers";
		$myresult = mysqli_query($db, $sql_command);
		while($id_rows = mysqli_fetch_assoc($myresult))
		{
			$id = $id_rows['pid'];
					echo "<option value=$id>".$id."</option>";
		}
	?>
	</select><br><br>
	<button>INSERT</button>
</form>

<br><br>

<b>TO DELETE AN EXISTING TICKET FROM THE DATABASE USE THE OPTION BUTTON BELOW TO SELECT THE ID OF THE TICKET TO BE DELETED: </b>
<br><br>
<form action="delete_tickets.php" method="POST">
<select name="ids">

<?php
	$sql_command = "SELECT tid FROM tickets";
	$myresult = mysqli_query($db, $sql_command);
	while($id_rows = mysqli_fetch_assoc($myresult))
	{
		$id = $id_rows['tid'];
				echo "<option value=$id>".$id."</option>";
	}
?>
</select>
<button>DELETE</button>
</form>
<br><br>

<b>TO SEARCH THE REQUIRED ROWS AND COLUMNS FROM THE TABLE: </b>
<br><br>
<form action="search_tickets.php" method="POST">
<b>SELECT </b>
<select name="select_clmn">
<?php
	$sql_com = "SHOW columns FROM tickets";
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
<b>FROM tickets T</b>
<br><br>
<b>WHERE T.</b>
<select name="where_clmn">
<?php
	$sql_com = "SHOW columns FROM tickets";
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