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

	$sql_stmt = "SELECT $selected_clmn FROM flights WHERE $conditioned_clmn = '$queried_value'";

	$result = mysqli_query($db, $sql_stmt);

	if($selected_clmn == "*")
	{
		echo "<tr>" . "<th>" . "ID" . "</th>" . "<th>" . "DATE" . "</th>" . "<th>" . "TIME" . "</th>" . "<th>" . "ARRIVAL TIME" . 
				"</th>" . "<th>" .  "DEPARTURE AIRPORT ID" . "</th>" . "<th>" . "DESTINATION AIRPORT ID" . "</th>" . "<th>" . "AIRLINE ID" .
				"</th>" . "</tr>";

		while($row = mysqli_fetch_assoc($result))
		{

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