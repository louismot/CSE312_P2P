<?php
require "includes/udbh.inc.php";
session_start();
 $userId = $_SESSION['userId'];

 $sql = "SELECT * FROM users WHERE idUsers= '$userId'";
 $result = mysqli_query($conn, $sql);
 $resultCheck = mysqli_num_rows($result);

 if($resultCheck > 0){
   if ($row = mysqli_fetch_assoc($result)) {
     $notifications = $row['Notifications'];


   }
 }
?>
     <?php echo $notifications ?>
