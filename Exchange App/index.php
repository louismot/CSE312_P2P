<?php
	require "header.php";
?>

	<main>

		<?php

		if (isset($_SESSION['userId'])) {

			echo 
			'<form action="includes/login.inc.php">
			<p class="login-status">Welcome {{mailuid}}!</p>
			</form>';
		}
		else{
			echo '<p class="login-status">You are not logged in!</p>';
		}

		 ?>
	</main>

<?php
	require "footer.php";
?>