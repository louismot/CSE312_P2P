<?php

if (isset($_POST['withdraw-submit'])) {
	
	require 'udbh.inc.php';

	$amount = $_POST['withdraw-amount'];
	$wallet = $_POST['wallet-withdraw'];
	