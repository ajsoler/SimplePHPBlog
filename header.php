<head>
			<?php
			session_start();
			require('admin/config.php');
			require('admin/functions.php');
			?>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<!-- My website CSS-->
			<link rel="stylesheet" type="text/css" href="css/style.css">
			<!-- Icons-->
			<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
			<!-- Fonts-->
			<link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
</head>
<body>
<?php if(isset($_SESSION['user_id'])){ validate_user_type($conn, $_SESSION['user_id'], $_SESSION['user'], $_SESSION['pass']); }?>
<!--Start Header if necessary-->
<div class="header">
  <h1>MY BlOG</h1>
</div>
<!--Ends Header if necessary-->

<!--Start Navigation Bar-->
<div class="clearfix">
<div class="navbar" id="navbar">
<div class="nav-icon">
			<a href="index.php"><i class="material-icons">menu</i></a>
</div>
<div class="nav-left">
  <a href="index.php">Home</a>
  <?php if(isset($_SESSION['type'])){ if ($_SESSION['type']==='admin' or $_SESSION['type']==='poster'){ ?><a href="admin/index.php">Admin</a><?php }}  ?>
  <a href="#about">About</a>
  <a href="#contact">Contact</a>
</div>
<div class="nav-right">
		<?php if(empty($_SESSION['user'])){ ?><a href="login.php">Login</a><?php }  ?>
		<?php if(empty($_SESSION['user'])){ ?><a href="register.php">Register</a><?php }  ?>
		<?php if(isset($_SESSION['user'])){ ?><a href="login.php?logout=1">[ Logout ]</a><?php }  ?>
		<?php if(isset($_SESSION['user'])){ ?><div class="welcome"><i class="material-icons">person</i><?php echo " ${_SESSION['user']}"; ?></div><?php }  ?>
		
</div>
</div>
</div>
<!--Ends Navigation Bar-->