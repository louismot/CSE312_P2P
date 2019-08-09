<?php
	require "header.php";
?>

	<main>
		<h1>Sign Up</h1>

		<?php
		if (isset($_GET['error'])) {
			if ($_GET['error'] == "emptyfields") {
				echo '<p> FILL IN ALL FIELDS!</p>';
			}
			else if ($_GET['error'] == "invalidmailuid") {
				echo '<p> INVALID USERNAME AND E-MAIL!</p>';
			}
			else if ($_GET['error'] == "invalidmail") {
				echo '<p> INVALID E-MAIL!</p>';
			}
			else if ($_GET['error'] == "invaliduid") {
				echo '<p> INVALID USERNAME!</p>';
			}
			else if ($_GET['error'] == "passwordcheck") {
				echo '<p> YOUR PASSWORDS DO NOT MATCH!</p>';
			}
			else if ($_GET['error'] == "usertaken") {
				echo '<p> USERNAME ALREADY EXISTS!</p>';
			}
		}
		else if ($_GET['signup'] == "success") {
			echo '<p> SIGN UP SUCCESSFUL!</p>';
		}
		else{
		 echo '<p> Please Sign Up! </p>';
		}
		 ?>

		<form action="includes/signup.inc.php" method="post">
			<!-- <input type="text" name="fName" placeholder="First Name...">
			<input type="text" name="lName" placeholder="Last Name...">
			<br></br> -->
			<input type="text" name="uid" placeholder="Username...">
			<input type="text" name="mail" placeholder="E-mail...">
			<br></br>
			<input type="password" name="pwd" placeholder="Password...">
			<input type="password" name="pwd-repeat" placeholder="Repeat password...">
			<br></br>
			<!-- <input type="text" name="city" placeholder="City...">
			<input type="text" name="state/province" placeholder="State/Province...">
			<br></br>
			<input type="text" name="zip" placeholder="Zip Code...">
			<input type="text" name="country" placeholder="Country...">
			<br></br> -->
			<button type="submit" name="signup-submit">Sign Up</button>
		</form>
	</main>

<?php
	require "footer.php";
?>