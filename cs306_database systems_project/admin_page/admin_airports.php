<!DOCTYPE html>
<html>
<head>
	<title>AIRPORTS ADMIN PAGE</title>
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
<b>WELCOME TO THE ADMIN PAGE OF THE AIRPORTS TABLE</b>
<br><br><br>
</div>
<div>
<b>THE CURRENT STATE OF THE AIRPORTS TABLE: </b>
<br><br>
</div>
<div align=CENTER>
<table>

<tr><th> ID </th><th> NAME </th><th> CITY </th><th> COUNTRY </th></tr>

<?php

include "config.php";

$sql_statement = "SELECT * FROM airports";

$result = mysqli_query($db, $sql_statement);

while($row = mysqli_fetch_assoc($result)){

	$id = $row['port_id'];
	$pname = $row['port_name'];
	$city = $row['city'];
	$country = $row['country'];
	echo "<tr>" . "<th>" . $id . "</th>" . "<th>" . $pname . "</th>" . "<th>" . $city . "</th>" . 
				"<th>" . $country . "</th>" . "</tr>";
}

?>

</table>
<br>
</div>


<div>
<b>TO INSERT A NEW AIRPORT TO THE DATABASE USE THE FORM BELOW: </b>
<br><br>
<form action="add_airports.php" method="POST">
	<textarea name="name" rows="2" cols="50" placeholder="Type your AIRPORT'S NAME here!"></textarea><br>
	<textarea name="city" rows="2" cols="50"placeholder="Type the name of the CITY that the airport is located in"></textarea><br>
	<textarea name="country" rows="2" cols="50"placeholder="Type the name of the COUNTRY that the airport is located in"></textarea><br>
	<button>INSERT</button>
</form>

<br><br>

<b>TO DELETE AN EXISTING AIRPORT FROM THE DATABASE USE THE OPTION BUTTON BELOW TO SELECT THE ID OF THE AIRPORT TO BE DELETED: </b>
<br><br>
<form action="delete_airports.php" method="POST">
<select name="ids">

<?php
	$sql_command = "SELECT port_id FROM airports";
	$myresult = mysqli_query($db, $sql_command);
	while($id_rows = mysqli_fetch_assoc($myresult))
	{
		$id = $id_rows['port_id'];
				echo "<option value=$id>".$id."</option>";
	}
?>
</select>
<button>DELETE</button>
</form>
<br><br>

<b>TO SEARCH THE REQUIRED ROWS AND COLUMNS FROM THE TABLE: </b>
<br><br>
<form action="search_airports.php" method="POST">
<b>SELECT </b>
<select name="select_clmn">
<?php
	$sql_com = "SHOW columns FROM airports";
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
<b>FROM airports A</b>
<br><br>
<b>WHERE A.</b>
<select name="where_clmn">
<?php
	$sql_com = "SHOW columns FROM airports";
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