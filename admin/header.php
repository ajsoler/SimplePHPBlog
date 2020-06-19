<head>
<?php
session_start();
require('config.php');
require('functions.php');
?>
<title>Administration Area</title>
<!-- Administration style CSS-->
<link rel="stylesheet" type="text/css" href="css/admin_style.css">
</head>
<body>
<header>
<?php 
if(empty($_SESSION['user_id'])
			or empty($_SESSION['user'])
			or empty($_SESSION['pass'])){header("Location:../login.php"); exit;}
else{ validate_user_type($conn,$_SESSION['user_id'],$_SESSION['user'],$_SESSION['pass']);
				if($_SESSION['type']==='admin' or $_SESSION['type']==='poster'){}
				else{echo "Access Denied. User not admin or poster."; exit;}
				}	
	?>

<div class="navbar">
  <a href="../index.php">Front End</a>
  <a href="index.php">Admin Home</a>
  <a href="add_post.php">Add Post</a>
		<a href="../login.php?logout=1"><b>[ Logout ]</b></a>
</div>
	
</header>
<div class="main">