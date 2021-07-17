<?php
session_start();
?>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
	<title id="title-text">Tic Tac Toe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="style.css" rel="stylesheet">
</head>


<body class="en mb-5">

<nav class="navbar navbar-light bg-light mb-5 fixed-top">
  <div class="container-fluid">
	<a class="navbar-brand en" href="#" id="btn-menu">Tic Tac Toe</a>
	<?php if(isset($_SESSION["code"]) && $_SESSION["code"] != ''){ ?>
		<a class="navbar-brand text-danger en" href="index.php?q=1" id="btn-menu">EXIT</a>
	<?php }else{ ?>
		
	<?php } ?>
  </div>
</nav>
<div class="pt-lg-5"></div>
<div class="container mt-5 pt-4 pb-2">
	<div class="row">
		<div class="col-sm-2 col-md-3 col-lg-4"></div>
		<div class="col-sm-8 col-md-6 col-lg-4">
			<?php include_once('xo.php'); ?>
		</div>
		<div class="col-sm-2 col-md-3 col-lg-4"></div>
	</div>
</div>
</body>

<div class="bg-light text-dark p-3 fixed-bottom shadow-1-strong en" dir="ltr">
	<div class="row">
		<div class="col d-flex justify-content-start"><a class="text-dark" href="https://github.com/benfodil" target="_blank">AdeL</a></div>
		<div class="col d-flex justify-content-end">© 2021</div>
	</div>
</div>

</html>