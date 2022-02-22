<?php 

include "config.php";

if (isset($_POST['tid']))
{

$pid = $_POST['pid'];
$selection_id = $_POST['tid'];

$sql_statement = "DELETE FROM tickets WHERE tid = '$selection_id'";

$result = mysqli_query($db, $sql_statement);


header ("Location: success.php");

}

else
{

	echo "The form is not set.";

}

?>