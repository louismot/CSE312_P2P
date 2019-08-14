<?php

if (isset($_POST['transfer-submit'])) {
	
	require 'udbh.inc.php';

	$amount = $_POST['transfer-amount'];
	$wallet = $_POST['wallet-transfer'];
	$rUsername = $_POST['transfer-rUsername'];
	$sUsername = $_POST['transfer-sUsername'];
	$pwd = $_POST['transfer-pwd'];

	


	if (empty($amount) || empty($wallet)) {
		header("Location: ../userprofile.php?error=emptyfields");
		exit();	
	}
	else{
		//start handling sUser data
		$sql = "SELECT * FROM users WHERE uidUsers= '$sUsername'";
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

				//check sUser password
				if ($pwdCheck == false) {
					header("Location: ../userprofile.php?error=wrongpwd");
					exit();
				}

			}

			//update rUsers data
			$sql = "UPDATE users SET $wallet=$wallet-$amount WHERE uidUsers='$sUsername'";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../userprofile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_execute($stmt);


			}

		}

	//start handling rUser data

	$sql2 = "SELECT * FROM users WHERE uidUsers= '$rUsername'";
	$stmt2 = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt2, $sql2)) {
		header("Location: ../userprofile.php?error=sqlerror");
		exit();
	}
	else{
		mysqli_stmt_execute($stmt2);
		$result2 = mysqli_stmt_get_result($stmt2);
		if ($row = mysqli_fetch_assoc($result2)) {

			$pwdCheck = password_verify($pwd, $row['pwdUsers']);

				//check sUser password
			if ($pwdCheck == false) {
				header("Location: ../userprofile.php?error=wrongpwd");
				exit();
			}

		}

			//update rUsers data
//		else{
		$sql2 = "UPDATE users SET $wallet=$wallet+$amount WHERE uidUsers='$rUsername'";
		$stmt2 = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt2, $sql2)) {
			header("Location: ../userprofile.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_execute($stmt2);

			$message = $sUsername." sent you ".$amount;

			$sql2 = "UPDATE users SET Notifications= '$message' WHERE uidUsers='$rUsername'";
			$stmt2 = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt2, $sql2)) {
			header("Location: ../userprofile.php?error=sqlerror".$message);
			exit();
			}
			mysqli_stmt_execute($stmt2);

			header("Location: ../userprofile.php?transfer=success".$amount."/".$wallet."/".$rUsername."/".$sUsername."/".$pwd."/");
			exit();
		}
//		}

	}
}
}

