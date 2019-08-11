<?php

//|| empty($lName) || empty($city) || empty($prov) || empty($zip) || empty($country)

if (isset($_POST['signup-submit'])) {
	require 'udbh.inc.php';

//	$fName = $_POST['fName'];
//	$lName = $_POST['lName'];
	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];
//	$city = $_POST['city'];
//	$prov = $_POST['state/province'];
//	$zip = $_POST['zip'];
//	$country = $_POST['country'];

	if (empty($username) || empty($email) || empty($password) //|| empty($passwordRepeat)*/) {
		header("Location: ../index.html?error=emptyfields&uid=".$username."&mail=".$email);
		exit();
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../index.html?error=invalidmailuid&uid=");
		exit();
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../index.html?error=invalidmail&uid=".$username);
		exit();
	}
	else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../index.html?error=invaliduid&uid=".$email);
		exit();
	}
/*	else if ($password !== $passwordRepeat) {
		header("Location: ../index.html?error=passwordcheck&uid".$username."&mail=".$email);
		exit();
	}*/
	else{

		$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.html?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("Location: ../index.html?error=usertaken&mail=".$email);
				exit();
			}
			else{
				$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../index.html?error=sqlerror");
					exit();
				}
				else{
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
					mysqli_stmt_execute($stmt);
					header("Location: ../index.html?signup=success");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else{
	header("Location: ../signup.php");
	exit();
}