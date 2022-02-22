<!DOCTYPE html>
<html>
<head>
	<title>SELECT DATE AND ADDRESS</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
include "config.php";

if ( isset($_POST['id']) )
{
	$id = $_POST['id'];

	$sql_id_check = "SELECT * from passengers where pid = '$id'";
	$res_check = mysqli_query($db, $sql_id_check);
	$row = mysqli_fetch_assoc($res_check);

	if ((mysqli_num_rows($res_check) == 0) || ($id == "0") || ($id == "") )
	{
		echo "<p style='color:black; font-family:verdana; font-size=300%'>Invalid ID! A person with this ID has not been registered!</p>" . "<br><br>";
		echo "<form action='userpage.php' method='POST'><button class='button_green'>GO BACK TO THE MAIN PAGE</button></form><br><br>";
	}
	else
	{
		echo "<h1>CHOOSE THE ADDRESS INFORMATION AND THE DATE OF THE FLIGHT</h1><br><br>";
		echo "<form action='find_flights.php' method='POST'><input type='hidden' name='pid' value='$id'>";
		echo "<b>FROM 	</b>";
		echo "<select name='from'>";
		$sql_command = "SELECT city, country FROM airports";
		$myresult = mysqli_query($db, $sql_command);
		while($id_rows = mysqli_fetch_assoc($myresult))
		{
			$city = $id_rows['city'];
			$country = $id_rows['country'];
			$info = $city . "/ " . $country;
			echo "<option value=$city>".$info."</option>";
		}
		echo "</select><br><br>";

		echo "<b>TO 	</b>";
		echo "<select name='to'>";
		$sql_command = "SELECT city, country FROM airports";
		$myresult = mysqli_query($db, $sql_command);
		while($id_rows = mysqli_fetch_assoc($myresult))
		{
			$city = $id_rows['city'];
			$country = $id_rows['country'];
			$info = $city . "/ " . $country;
			echo "<option value=$city>".$info."</option>";
		}
		echo "</select><br><br>";

		echo "<b>ON 	</b>";
		echo "<input type='text' name='date' placeholder='DATE in (YYYY-MM-DD) format'></textarea><br><br><br><button>FIND FLIGHTS</button>";
		//include "dropdown_calendar.php"
		echo "</form>";
		echo "<br><br><br><form action='userpage.php' method='POST'><button class='button_green'>GO BACK TO THE MAIN PAGE</button></form><br><br>";
	}
}

else
{
	echo "The form is not set.";
}
?>
</body>
</html>