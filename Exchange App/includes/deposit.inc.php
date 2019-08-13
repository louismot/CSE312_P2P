<?php

if (isset($_POST['deposit-submit'])) {
	
	require 'udbh.inc.php';
	$amount = $_POST['deposit-amount'];
	$wallet = $_POST['wallet-deposit'];


	if (empty($amount) || empty($wallet)) {
		header("Location: ../userprofile.html?error=emptyfields");
		exit();	
	}
	else{
		
		$sql = "UPDATE users SET $wallet=$wallet+$amount, bank=bank-$amount WHERE idUsers= ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../userprofile.html?error=sqlerror");
			exit();
		}
		else{
			$result = mysqli_stmt_get_result($stmt);
//			if ($row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))) {

			session_start();
			$_SESSION['userId'] = $row['idUsers'];
			$_SESSION['userUid'] = $row['uidUsers'];
//			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			header("Location: ../userprofile.html?deposit=success".$_SESSION['userId']);
			exit();

//			}
			/*session_start();
			$_SESSION['userId'] = $row['idUsers'];
			$_SESSION['userUid'] = $row['uidUsers'];
//			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			header("Location: ../userprofile.html?deposit=success".$_SESSION['userId']);
			exit();*/
		}
	}
}
