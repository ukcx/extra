<?php 

include "config.php";

if (isset($_POST['ids']))
{

$selection_id = $_POST['ids'];


$sql_statement = "DELETE FROM flights WHERE fid = '$selection_id'";

$result = mysqli_query($db, $sql_statement);

header ("Location: admin_flights.php");

}

else
{

	echo "The form is not yet set.";

}

?>