<?php 

include "config.php";

if (isset($_POST['ids']))
{

$selection_id = $_POST['ids'];


$sql_statement = "DELETE FROM passengers WHERE pid = '$selection_id'";

$result = mysqli_query($db, $sql_statement);

header ("Location: admin_passengers.php");

}

else
{

	echo "The form is not yet set.";

}

?>