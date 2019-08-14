<?php
require "includes/udbh.inc.php";
 ?>

 <!DOCTYPE html>
 <html>
 <head>

  <p>
       Wallet A|  Wallet B| Bank|
   <br>
        1    =     5    =   10
  </p>
 	<title>
    
   Wallet A|  Wallet B| Bank|

      1    =     5    =   10

  </title>
 </head>
 <body>

 	<?php
 		$sql = "SELECT * FROM users;";
 		$result = mysqli_query($conn, $sql);
 		$resultCheck = mysqli_num_rows($result);

 		if($resultCheck > 0){
 			if ($row = mysqli_fetch_assoc($result)) {
 				$walletA = $row['walletA'] . "<br>";
 				$walletB = $row['walletB'] . "<br>";
 				$bank = $row['bank'] . "<br>";


 			}
 		}
 	 ?>
 	  <table style="width:100%">
  <tr>
    <th>Wallet A</th>
    <th>Wallet B</th>
    <th>Bank</th>
  </tr>
  <tr>
    <td><?php
    echo $walletA;
    ?></td>
    <td><?php
    echo $walletB;
    ?></td>
    <td><?php
    echo $bank;
    ?></td>
  </tr>
</table>

<form action="includes/deposit.inc.php" method="post">
  <br>
	<input type="text" name="deposit-amount" placeholder="Amount">
  <input type="text" name="wallet-deposit" placeholder="Wallet">
  <br>
	<button type="Deposit" name="deposit-submit">Deposit</button>
  <br>
</form>

<form action="includes/withdraw.inc.php" method="post">
  <br>
  <input type="text" name="withdraw-amount" placeholder="Amount">
  <input type="text" name="wallet-withdraw" placeholder="Wallet">
  <br>
  <button type="Withdraw" name="withdraw-submit">Withdraw</button>
  <br>
</form>


 
 </body>
 </html>