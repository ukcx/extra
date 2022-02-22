<!DOCTYPE html>
<html>
<head>
	<title>MAIN USER PAGE</title>
	<link rel="stylesheet" href="./styles.css">
<style>		
	body
	{
		margin: 0;
  		height: 100%;
  		width: 100%;
	}
	div {
  		background-image: url('./gifs/p2.png');
  		width: 100%;
  		height: 100%;
  		background-size: cover;
}

</style>
</head>
<body>
<div>
<center>
	<br>
<h1>THE AIR TRAVEL WEB PAGE</h1>
</center>
<br>
<p>--  If You Haven't Registered Yet, Register From Here</p>
<form action="user_register.php" method="POST">
	<button class="button_green">REGISTER</button>
</form>
<p>--		To Check your Tickets, Type your ID and Click the Button Below</p>
<form action="mytickets.php" method="POST">
	<input type="text" name="log_id" placeholder="Type your ID number here"><br>
	<button class="button_green">FIND MY TICKETS</button>
</form></p>

<p>--	To Book A Seat From A Flight, Type your ID and Click the Button Below</p>
<form action="book_flights.php" method="POST">
	<input type="text" name="id" placeholder="Type your ID number here"><br>
	<button class="button_green">FIND FLIGHTS</button>
</form>
<p>--		To Cancel A Booking, Type your ID and Click the Button Below</p>
<form action="cancel_bookings.php" method="POST">
	<input type="text" name="id" placeholder="Type your ID number here"><br>
	<button class="button_red">CANCEL A BOOKING</button>
</form><br><br><br>
</div>
</body>
</html>