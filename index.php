<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<title>Error 500</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<?php

	$servermac = "aa:bb:cc:dd:ee:ff";
	$serverip = "192.168.2.250";
	$name = "Neo";

	$ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];

	if ($_GET['wake']) {
		exec ("wakeonlan $servermac");
		$status = "packets sent.";
		$statusmsg = "Knock, knock, $name.";
	}

	$pinginfo = exec("ping -c 1 $serverip");

	if ($pinginfo != "" ) {
		$status = "awaked.";
		$statusmsg = "The Matrix has you.";
	}

	if ($pinginfo == "" AND $_GET['wake']) {
		$page = $_SERVER['PHP_SELF'];
		$sec = "1";
		header("Refresh: $sec; url=?wake=true");
	}

	?>

	<?php if ($pinginfo != "") { ?>
		<canvas id="c"></canvas>
		<div class="diffuse"></div>
	<?php }
	else { ?>
		<div class="overlay"></div>
	<?php } ?>
	<div class="terminal">
		<h1>ERROR  <span class="errorcode">500</span></h1>
		<p class="output">This is not the place you are looking for. Run.</p>
		<p class="output"></p>
		<p class="output">Call trans opt: received. <?php echo date("c"); ?></p>
		<p class="output">Trace program: running. <?php echo $ip ?></p>
		<p class="output"></p>

		<?php if ($status != "") { ?>
			<p class="output">Status: <?php echo $status ?></p>
			<p class="output"><?php echo $statusmsg ?></a></p>
		<?php }
		else { ?>
			<p class="output"><a href="?wake=true"">Wake up, <?php echo $name ?></a> ... follow the white rabbit.</a></p>
		<?php } ?>
	</div>

	<script  src="js/index.js"></script>

</body>

</html>
