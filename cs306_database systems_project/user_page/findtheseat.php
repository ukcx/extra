<!DOCTYPE html>
<html>
<head>
	<title>CHOOSE A SEAT</title>
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
	$id = $_POST['id'];
	$pid = $_POST['pid'];
	$class = $_POST['class'];

	echo "<br><p>SELECT THE SEAT NUMBER</p>" . "<br><br>";
	//echo "Ask for economy or business";
	//echo "Dropdown table for seats";
	//echo "Button to book the seat";
	//echo "send to book_the_seat.php page";

	echo "<form action='book_the_seat.php' method='POST'><input type='hidden' name='pid' value='$pid'>";


	echo "<p>Seat No</p>";
	echo "<select name='sno'>";

	if( $class == "business")
	{
		$s = 'A';
		for($x = 1; $x <= 6; $x++)
		{
			for($y = 1; $y <= 4; $y++ )
			{
				$opt_val =  $s . $y;
				echo "<option value=$opt_val>". $opt_val ."</option>";
			}
			$s++;
		}
	}
	else
	{
		$s = 'G';
		for($x = 7; $x <= 20; $x++)
		{
			for($y = 1; $y <= 6; $y++ )
			{
				$opt_val =  $s . $y;
				echo "<option value=$opt_val>". $opt_val ."</option>";
			}
			$s++;
		}
	}

	echo "</select><input type='hidden' name='id' value='$id'><input type='hidden' name='class' value='$class'><button class='button_green'>BOOK THIS SEAT</button>";
	echo "</form>";

	echo "<br><br><form action='book_flights.php' method='POST'><input type='hidden' name='id' value='$pid'><button class='button_red'>GO BACK TO THE PAGE WHERE THE DATE AND ADDRESS INFORMATION IS BEING CHOSEN</button></form><br><br>";
}
else
{
	echo "The form is not set.";
}

?>

</body>
</html>