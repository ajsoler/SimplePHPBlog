<!doctype html>
<html>
<?php include('header.php'); ?>
<?php
if (isset($_POST['add_post'])) {
$sql = "INSERT INTO `posts` (`post_id`, `title`, `youtube`, `content`, `user_id`, `image_url`, `date`) VALUES (NULL, '" . htmlspecialchars($_POST['title'],ENT_QUOTES) . "', NULL, '" . htmlspecialchars($_POST['content'],ENT_QUOTES) . "', '" . $_SESSION['user_id'] . "', '" . htmlspecialchars($_POST['image_url'],ENT_QUOTES) . "', CURRENT_DATE()      )";
if (!mysqli_query($conn,$sql)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. Post published.</p>";}
} else {
?>
<h2>Add Post</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="col s12">
				Title: <input placeholder="Title for your post" id="title" name="title" type="text" class="validate" required>
				<br><br>
				Image url: <input placeholder="Image url if any" id="image_url" name="image_url" type="text" class="validate">
				<br><br>
				<textarea name="content" class="tiny"></textarea>
				<br>
				<button class="button" type="submit" name="add_post" id="add_post" value="add_post">Submit</button>
</form>
<?php }
include('footer.php'); ?>
</html>