<!DOCTYPE html>
<html>
<head>
	<title>AIRLINES ADMIN PAGE</title>
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
<b>WELCOME TO THE ADMIN PAGE OF THE AIRLINES TABLE</b>
<br><br><br>
</div>
<div>
<b>THE CURRENT STATE OF THE AIRLINES TABLE: </b>
<br><br>
</div>
<div align=CENTER>
<table>

<tr><th> ID </th><th> NAME </th></tr>

<?php

include "config.php";

$sql_statement = "SELECT * FROM airlines";

$result = mysqli_query($db, $sql_statement);

while($row = mysqli_fetch_assoc($result)){

	$id = $row['line_id'];
	$lname = $row['line_name'];
	echo "<tr>" . "<th>" . $id . "</th>" . "<th>" . $lname . "</th>" . "</tr>";
}

?>

</table>
<br>
</div>


<div>
<b>TO INSERT A NEW AIRLINE COMPANY TO THE DATABASE USE THE FORM BELOW: </b>
<br><br>
<form action="add_airlines.php" method="POST">
	<textarea name="name" rows="2" cols="50" placeholder="Type your AIRLINE COMPANY'S NAME here!"></textarea><br>
	<button>INSERT</button>
</form>

<br><br>

<b>TO DELETE AN EXISTING AIRLINE COMPANY FROM THE DATABASE USE THE OPTION BUTTON BELOW TO SELECT THE ID OF THE AIRLINE COMPANY TO BE DELETED: </b>
<br><br>
<form action="delete_airlines.php" method="POST">
<select name="ids">

<?php
	$sql_command = "SELECT line_id FROM airlines";
	$myresult = mysqli_query($db, $sql_command);
	while($id_rows = mysqli_fetch_assoc($myresult))
	{
		$id = $id_rows['line_id'];
				echo "<option value=$id>".$id."</option>";
	}
?>
</select>
<button>DELETE</button>
</form>
<br><br>

<b>TO SEARCH THE REQUIRED ROWS AND COLUMNS FROM THE TABLE: </b>
<br><br>
<form action="search_airlines.php" method="POST">
<b>SELECT </b>
<select name="select_clmn">
<?php
	$sql_com = "SHOW columns FROM airlines";
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
<b>FROM airlines L</b>
<br><br>
<b>WHERE L.</b>
<select name="where_clmn">
<?php
	$sql_com = "SHOW columns FROM airlines";
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