<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="This is an example of a meta description. This will often show up on search results.">
		<meta name=viewport content="width=device-width, initial-scale=1"
		<title></title>
		<br></br>
	</head>
	<body>

		<header>
			    <nav>
      </div>
    


				<a href="#">
					
				</a>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="account.php">Account</a></li>
					<li><a href="#">Contacts</a></li>
				</ul>

				<div>
					<?php
						if (isset($_SESSION['userId'])) {
							echo 
							'<form action="includes/logout.inc.php" method="post">
								<button type="submit" name="logout-submit">Logout</button>
							</form>';
						}
						else{
							echo 
							'<form action="includes/login.inc.php" method="post">
								<input type="text" name="mailuid" placeholder="Username/E-mail...">
								<input type="password" name="pwd" placeholder="Password...">
								<button type="submit" name="login-submit">Login</button>
								<br></br>
							</form>
							<a href="signup.php">Sign Up</a>';
						}
					 ?>
				</div>
			</nav>
		</header>
	</body>

</html>