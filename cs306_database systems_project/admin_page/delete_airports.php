<?php 

include "config.php";

if (isset($_POST['ids']))
{

$selection_id = $_POST['ids'];


$sql_statement = "DELETE FROM airports WHERE port_id = $selection_id";

$result = mysqli_query($db, $sql_statement);

header ("Location: admin_airports.php");

}

else
{

	echo "The form is not yet set.";

}

?>