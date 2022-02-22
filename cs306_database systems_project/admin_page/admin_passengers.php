<!DOCTYPE html>
<html>
<head>
	<title>PASSENGERS ADMIN PAGE</title>
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
<b>WELCOME TO THE ADMIN PAGE OF THE PASSENGERS TABLE</b>
<br><br><br>
</div>
<div>
<b>THE CURRENT STATE OF THE PASSENGERS TABLE: </b>
<br><br>
</div>
<div align=CENTER>
<table>

<tr><th> ID </th><th> FULL NAME </th><th> PHONE </th><th> E-MAIL </th><th> TYPE </th></tr>

<?php

include "config.php";

$sql_statement = "SELECT * FROM passengers";

$result = mysqli_query($db, $sql_statement);

while($row = mysqli_fetch_assoc($result)){

	$id = $row['pid'];
	$fullname = $row['full_name'];
	$phone = $row['phone'];
	$email = $row['email'];
	$type = $row['p_type'];
	echo "<tr>" . "<th>" . $id . "</th>" . "<th>" . $fullname . "</th>" . "<th>" . $phone . "</th>" . "<th>" . $email . "</th>" . 
				"<th>" . $type . "</th>" . "</tr>";
}

?>

</table>
<br>
</div>


<div>
<b>TO INSERT A NEW PASSENGER TO THE DATABASE USE THE FORM BELOW: </b>
<br><br>
<form action="add_passengers.php" method="POST">
	<textarea name="id" rows="2" cols="50" placeholder="Type your PASSENGER ID here!"></textarea><br>
	<textarea name="name" rows="2" cols="50" placeholder="Type your FULL NAME here!"></textarea><br>
	<textarea name="phone" rows="2" cols="50" placeholder="Type your PHONE NUMBER here!"></textarea><br>
	<textarea name="email" rows="2" cols="50" placeholder="Type your E-MAIL here!"></textarea><br>
	<textarea name="type" rows="2" cols="50" placeholder="Type your TYPE here! (child, student or adult)"></textarea><br>
	<button>INSERT</button>
</form>

<br><br>

<b>TO DELETE AN EXISTING PASSENGER FROM THE DATABASE USE THE OPTION BUTTON BELOW TO SELECT THE ID OF THE PASSENGER TO BE DELETED: </b>
<br><br>
<form action="delete_passengers.php" method="POST">
<select name="ids">

<?php
	$sql_command = "SELECT pid FROM passengers";
	$myresult = mysqli_query($db, $sql_command);
	while($id_rows = mysqli_fetch_assoc($myresult))
	{
		$id = $id_rows['pid'];
				echo "<option value=$id>".$id."</option>";
	}
?>
</select>
<button>DELETE</button>
</form>
<br><br>

<b>TO SEARCH THE REQUIRED ROWS AND COLUMNS FROM THE TABLE: </b>
<br><br>
<form action="search_passengers.php" method="POST">
<b>SELECT </b>
<select name="select_clmn">
<?php
	$sql_com = "SHOW columns FROM passengers";
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
<b>FROM passengers P</b>
<br><br>
<b>WHERE P.</b>
<select name="where_clmn">
<?php
	$sql_com = "SHOW columns FROM passengers";
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