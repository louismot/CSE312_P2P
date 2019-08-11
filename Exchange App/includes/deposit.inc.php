<?php

if (isset($_POST['deposit-submit'])) {
	
	require 'udbh.inc.php';

	$amount = $_POST['deposit-amount'];
	$wallet = $_POST['wallet-deposit'];


	if (empty($amount) || empty($wallet)) {
		header("Location: ../account.php?error=emptyfields");
		exit();	
	}
	else{
		$sql = "UPDATE users SET  ;";
		$stmt = mysqli_stmt_init($conn);
}
