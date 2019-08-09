<?php
require "includes/udbh.inc.php";
require "header.php"
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
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

<form>
	


</form>

 
 </body>
 </html>