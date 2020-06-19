<!doctype html>
<html>
<?php 
include('header.php');

// If session logout link is pressed then destroy session
if (isset($_GET['logout'])) {
if ($_GET['logout'] == 1) {
session_destroy();
header("Location:login.php"); exit;}}
// Ends session logout	

//If session is set, return the user to the main page.
if (isset($_SESSION['user'])) {
header("Location:index.php"); exit;}	

//Process login post form
if (isset($_POST['login'])) { login_validation($conn,$_POST['user'],$_POST['pass']); }
?>
<div class="main">
							<div class="login">
                <form method="post">
                    <h2>Login</h2>
																				
                    <p><i class="material-icons prefix">person</i>
                    <input type="text" id="user" name="user"  placeholder="Username" value="<?php echo $_POST['user'] ?? '' ?>"></p>
																				<p><?php if (isset($error_user)) { ?><strong><?php echo $error_user; ?></strong><?php } ?></p>
	                   
																				<p><i class="material-icons prefix">lock</i>
  																		<input  type="password" id="pass" name="pass"  placeholder="Password"></p>
																				<p><?php if (isset($error_pass)) { ?><strong><?php echo $error_pass; ?></strong><?php } ?></p>
																	
                    <button class="button" type="submit" name="login" value="login">Login</button>
                    <p><?php if (isset($error_login)) { ?><strong><?php echo $error_login; ?></strong><?php } ?></p>

                </form>
					</div>	
</div>
<?php include('footer.php'); ?>
</html>