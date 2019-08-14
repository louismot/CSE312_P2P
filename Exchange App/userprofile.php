<?php
require "includes/udbh.inc.php";

session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Project</title>
    <link rel="stylesheet" href="style/mycss.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
      //JQuery code here!

      });
    </script>
  </head>
  <body class="bodybg">
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <a class="navbar-brand" href="#">Website Name</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item">
              <!-- Friends button functionality -->
            <a class="btn btn-dark" href="friends.html">Friends </a>
          </li>
          <!-- end of friends button -->
          <li class="nav-item">
              <!-- Notifications button functionality -->
            <button class="btn btn-dark" data-toggle="modal" data-target="#notifModal" type="button">Notifications
              <span class="badge badge-light">4</span> <!-- Have to replace with actual number of notifs-->
            </button>
          </li>
          <!-- end of notifications button -->
          <li class="nav-item">
            <!-- Logout button functionality (does nothing for now)-->

           <a class="btn btn-dark" href="includes/logout.inc.php">Logout </a>
          </li>
          <!-- end of logout button-->
        </ul>
      </div>
    </nav>
    <!-- end of navbar -->

<!-- Pop up modal - displays list of notifs (does nothing for now) -->
<div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Notifications</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Notifs to come here
      </div>
    </div>
  </div>
</div>
<!-- end of notifications modal-->
    <!-- Page content -->
    <!-- Displaying welcome user -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Welcome @<?php echo $_SESSION['userUid'] ?>!</h1>
      </div>
    </div>
    <!-- End of welcome -->
    <h6> View Wallet and Account Balances </h6>
    <!-- Table for Account Balance -->
    <div>
    <table class="table table-bordered table-dark w-50 mx-auto">

    <?php

    $userId = $_SESSION['userId'];

    $sql = "SELECT * FROM users WHERE idUsers= '$userId'";
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

      <tbody>
        <tr>
          <th scope="row">Bytecoin</th>
          <td>
            <?php echo $walletA; ?>
          </td> <!-- Add real balances -->
        </tr>
        <tr>
          <th scope="row">Heavycoin</th>
          <td><?php echo $walletB ?></td>
        </tr>
        <tr>
          <th scope="row">USD Bank Account</th>
          <td><?php echo $bank ?></td>
        </tr>
      </tbody>
    </table>
  </div>
<!-- End of table -->
/*
<!-- Button for Transfer -->
<button class="btn btn-light" data-toggle="modal" data-target="#transferModal" type="button">Transfer</button>

<!-- Pop up modal - Transfer form -->
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Transfer to User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Transfer form -->
        <form method="post" action= "includes/transfer.inc.php">
          <div class="form-group form-check">
            <input class="form-check-input" type="radio" name="wallet-transfer" id="withdrawwallet1" value="walletA">
            <label class="form-check-label" for="transferwallet1">Wallet 1</label>
            <br>
            <input class="form-check-input" type="radio" name="wallet-transfer" id="withdrawwallet2" value="walletB">
            <label class="form-check-label" for="transferwallet2">Wallet 2</label>
            <br>
            <input class="form-check-input" type="radio" name="bank-transfer" id="withdrawwallet2" value="bank">
            <label class="form-check-label" for="transferbank">Bank</label>
          </div>
          <div class="form-group">
            <label for="transferamt">Amount</label>
            <input type="input" class="form-control" name="transfer-amount" id="transferamt" placeholder="Enter Amount" required>
          </div>
          <div class="form-group">
            <label for="to-username">Send To</label>
            <input type="text" class="form-control" name="transfer-rUsername" id="to-username" placeholder="Enter Their Username" required>
          </div>
          <div class="form-group">
            <label for="username">Your Username</label>
            <input type="text" class="form-control" name="transfer-sUsername" id="username" placeholder="Enter Your Username" required>
          </div>
          <div class="form-group">
            <label for="pwd">Your Password</label>
            <input type="password" class="form-control" name="transfer-pwd" id="pwd" placeholder="Enter Password" required>
          </div>
          <button type="submit" name="transfer-submit"class="btn btn-dark">Submit</button>
        </form>
        <!-- end of transfer form -->
      </div>
    </div>
  </div>
</div>
<!-- End of transfer modal -->

<!-- Button for Deposit -->
<button class="btn btn-light" data-toggle="modal" data-target="#depositModal" type="button">Deposit</button>

<!-- Pop up modal - deposit form -->
<div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
        Deposit into Wallet
        <br>
        1 USD = .5 Bytecoin
        <br>
        1 USD = .8 Heavycoin
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Deposit form -->
        <form method="post" action= "includes/deposit.inc.php">
          <div class="form-group form-check">
            <input class="form-check-input" type="radio" name="wallet-deposit" id="depositwallet1" value="walletA">
            <label class="form-check-label" for="depositwallet1">Wallet 1</label>
            <br>
            <input class="form-check-input" type="radio" name="wallet-deposit" id="depositwallet2" value="walletB">
            <label class="form-check-label" for="depositwallet2">Wallet 2</label>
          </div>
          <div class="form-group">
            <label for="depositamt">Amount</label>
            <input type="input" class="form-control" name="deposit-amount" id="depositamt" placeholder="Enter Amount" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="deposit-username" id="depositamt" placeholder="Enter Username" required>
          </div>
          <div class="form-group">
            <label for="pwd">Password</label>
            <input type="password" class="form-control" name="deposit-pwd" id="depositamt" placeholder="Enter Password" required>
          </div>
          <button type="submit" name="deposit-submit" class="btn btn-dark">Submit</button>
        </form>
        <!-- end of deposit form -->
      </div>
    </div>
  </div>
</div>
<!-- End of deposit modal -->

<!-- Button for Withdraw -->
<button class="btn btn-light" data-toggle="modal" data-target="#withdrawModal" type="button">Withdraw</button>

<!-- Pop up modal - withdraw form -->
<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          Withdraw from Wallet
          <br>
          1 USD = .5 Bytecoin
          <br>
          1 USD = .8 Heavycoin
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Withdraw form -->
        <form method="post" action= "includes/withdraw.inc.php">
          <div class="form-group form-check">
            <input class="form-check-input" type="radio" name="wallet-withdraw" id="withdrawwallet1" value="walletA">
            <label class="form-check-label" for="withdrawwallet1">Wallet 1</label>
            <br>
            <input class="form-check-input" type="radio" name="wallet-withdraw" id="withdrawwallet2" value="walletB">
            <label class="form-check-label" for="withdrawwallet2">Wallet 2</label>
          </div>
          <div class="form-group">
            <label for="withdrawamt">Amount</label>
            <input type="input" class="form-control" name="withdraw-amount" id="withdrawamt" placeholder="Enter Amount" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="withdraw-username" id="depositamt" placeholder="Enter Username" required>
          </div>
          <div class="form-group">
            <label for="pwd">Password</label>
            <input type="password" class="form-control" name="withdraw-pwd" id="depositamt" placeholder="Enter Password" required>
          </div>
          <button type="submit" name="withdraw-submit"class="btn btn-dark">Submit</button>
        </form>
        <!-- end of withdraw form -->
      </div>
    </div>
  </div>
</div>
<!-- End of withdraw modal -->


</body>
</html>
