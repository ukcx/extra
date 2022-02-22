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

	$sql_stmt = "SELECT $selected_clmn FROM passengers WHERE $conditioned_clmn = '$queried_value'";

	$result = mysqli_query($db, $sql_stmt);

	if($selected_clmn == "*")
	{
		echo "<tr>" . "<th>" .  "ID" . "</th>" . "<th>" . "FULL NAME" . "</th>" . "<th>" . "PHONE" 
			. "</th>" . "<th>" . "E-MAIL" . "</th>" . "<th>" .  "TYPE" .  "</th>" . "</tr>";

		while($row = mysqli_fetch_assoc($result))
		{

			$id = $row['pid'];
			$fullname = $row['full_name'];
			$phone = $row['phone'];
			$email = $row['email'];
			$type = $row['p_type'];
			echo "<tr>" . "<th>" . $id . "</th>" . "<th>" . $fullname . "</th>" . "<th>" . $phone . "</th>" . "<th>" . $email . "</th>" . 
					"<th>" . $type . "</th>" . "</tr>";
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