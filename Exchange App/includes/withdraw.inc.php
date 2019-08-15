<?php

if (isset($_POST['withdraw-submit'])) {
	
	require 'udbh.inc.php';

	$amount = $_POST['withdraw-amount'];
	$wallet = $_POST['wallet-withdraw'];
	
	$username = $_POST['withdraw-username'];
	$pwd = $_POST['withdraw-pwd'];






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
			if (($wallet=="walletA" && $row[$wallet]-($amount*2) < 0)||($wallet=="walletB" && $row[$wallet]-($amount*1.25) < 0)) {
				header("Location: ../userprofile.php?withdraw=fail=negative-funds");
				exit();
			}
			else if($wallet == "walletA"){

				$sql = "UPDATE users SET $wallet=$wallet-($amount), bank=bank+($amount*2) WHERE uidUsers='$username'";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../userprofile.php?error=sqlerror");
				exit();
				}
				else{
					mysqli_stmt_execute($stmt);
					header("Location: ../userprofile.php?withdraw=success");
					exit();
				}
			}
			else if($wallet == "walletB"){

				$sql = "UPDATE users SET $wallet=$wallet-$amount, bank=bank+($amount*1.25) WHERE uidUsers='$username'";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../userprofile.php?error=sqlerror");
				exit();
				}
				else{
					mysqli_stmt_execute($stmt);
					header("Location: ../userprofile.php?withdraw=success");
					exit();
				}
			}
		}
	
}
