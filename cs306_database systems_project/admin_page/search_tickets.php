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
<table>
<?php 

include "config.php";

if (isset($_POST['query_clmn']))
{

	$selected_clmn = $_POST['select_clmn'];
	$conditioned_clmn = $_POST['where_clmn'];
	$queried_value = $_POST['query_clmn'];

	$sql_stmt = "SELECT $selected_clmn FROM tickets WHERE $conditioned_clmn = '$queried_value'";

	$result = mysqli_query($db, $sql_stmt);

	if($selected_clmn == "*")
	{
		echo "<tr>" . "<th>" . "ID" . "</th>" . "<th>" . "CLASS" . "</th>" . "<th>" . "SEAT NO" . "</th>" . "<th>" . "PRICE" . 
				"</th>" . "<th>" . "FLIGHT ID" . "</th>" . "<th>" . "PASSENGER ID" . "</th>" . "</tr>";

		while($row = mysqli_fetch_assoc($result))
		{
			$id = $row['tid'];
			$class = $row['class'];
			$seat_no = $row['seat_no'];
			$price = $row['price'];
			$flight_id = $row['flight_id'];
			$passenger_id = $row['passenger_id'];
			
			echo "<tr>" . "<th>" . $id . "</th>" . "<th>" . $class . "</th>" . "<th>" . $seat_no . "</th>" . "<th>" . $price . "</th>" . "<th>" . $flight_id . "</th>" . "<th>" . $passenger_id . "</th>" . "</tr>";
		}
	}
	else
	{
		echo "<tr>" . "<th>" . $selected_clmn . "</th>" . "</tr>";
		while($row = mysqli_fetch_assoc($result))
		{
			$value = $row[$selected_clmn];
			echo "<tr>" . "<th>" . $value . "</th>" . "</tr>";
		}
	}

}

else
{

	echo "The form is not yet set.";

}

?>
</table>