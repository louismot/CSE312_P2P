<?php

if (isset($_POST['deposit-submit'])) {
	
	require 'udbh.inc.php';

	$amount = $_POST['deposit-amount'];
	$wallet = $_POST['wallet-deposit'];
	$username = $_POST['deposit-username'];
	$pwd = $_POST['deposit-pwd'];




/*	if (empty($amount) || empty($wallet)) {
		header("Location: ../userprofile.php?error=emptyfields");
		exit();	
	}*/

		$sql = "SELECT * FROM users WHERE uidUsers= '$username'";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../userprofile.php?error=sqlerror");
			exit();
		}
		
		else{
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {

			$pwdCheck = password_verify($pwd, $row['pwdUsers']);

				if ($pwdCheck == false) {
					header("Location: ../userprofile.php?error=wrongpwd");
					exit();
				}

			}
			if ($row['bank']-$amount < 0) {
				header("Location: ../userprofile.php?deposit=fail=negative-funds");
				exit();
			}
			else if($wallet == "walletA"){

				$sql = "UPDATE users SET $wallet=$wallet+($amount*.5), bank=bank-$amount WHERE uidUsers='$username'";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../userprofile.php?error=sqlerror");
				exit();
				}
				else{
					mysqli_stmt_execute($stmt);
					header("Location: ../userprofile.php?deposit=success");
					exit();
				}
			}
			else if($wallet == "walletB"){

				$sql = "UPDATE users SET $wallet=$wallet+($amount*.8), bank=bank-$amount WHERE uidUsers='$username'";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../userprofile.php?error=sqlerror");
				exit();
				}
				else{
					mysqli_stmt_execute($stmt);
					header("Location: ../userprofile.php?deposit=success");
					exit();
				}
			}
		}
	}
	

