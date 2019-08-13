<?php

if (isset($_POST['withdraw-submit'])) {
	
	require 'udbh.inc.php';

	$amount = $_POST['withdraw-amount'];
	$wallet = $_POST['wallet-withdraw'];
	
	if (empty($amount) || empty($wallet)) {
		header("Location: ../userprofile.html?error=emptyfields");
		exit();	
	}
	else{
		$sql = "UPDATE users SET bank=bank+$amount, $wallet=$wallet-$amount WHERE idUsers=2;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../userprofile.html?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			header("Location: ../userprofile.html?withdraw=success");
			exit();
		}
	}
}