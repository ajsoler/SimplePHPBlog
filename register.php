<!doctype html>
<html>
<?php include('header.php'); 
//If session is set, return the user to the main page.
if(isset($_SESSION['user'])){ header( "Location:index.php" ); }


if(isset($_POST['register'])){

register_validation($conn, $_POST['user'],$_POST['pass'],$_POST['email']);

}
?>
<div class="main">
							<div class="login">
    <h2>Register</h2>
				<form method="post">
								<p><i class="material-icons prefix">person</i>
								<input type="text" id="user" name="user"  placeholder="Username" value="<?php echo $_POST['user'] ?? '' ?>"></p>
								<p><?php if (isset($error_user)) { ?><strong><?php echo $error_user; ?></strong><?php } ?></p>
					
								<p><i class="material-icons prefix">lock</i>
								<input  type="password" id="pass" name="pass"  placeholder="Password"></p>
								<p><?php if (isset($error_pass)) { ?><strong><?php echo $error_pass; ?></strong><?php } ?></p>
					
								<p><i class="material-icons prefix">email</i>
								<input type="text" id="email" name="email"  placeholder="myemail@email.com" value="<?php echo $_POST['email'] ?? '' ?>"></p>
								<p><?php if (isset($error_email)) { ?><strong><?php echo $error_email; ?></strong><?php } ?></p>
					
								<p><button class="button" type="submit" name="register" value="register">Register</button></p>
								<p><?php if (isset($error_register)) { ?><strong><?php echo $error_register; ?></strong><?php } ?></p>
					
					
					
    </form>
 
  				</div>	
</div>
  

<?php include('footer.php'); ?>
</html>