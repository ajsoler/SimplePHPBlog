<!doctype html>
<html>
<?php include('header.php'); ?>
<?php
if (empty($_POST['post_id'])) { ?>
        <p>Please select Post from Admin Home.</p>
    <?php
exit;} else {
    if (isset($_POST['update_post'])) {
        $sql = "UPDATE `posts` SET `title` = '" . htmlspecialchars($_POST['title'],ENT_QUOTES) . "', `content` = '" . htmlspecialchars($_POST['content'],ENT_QUOTES) . "', `image_url` = '" . htmlspecialchars($_POST['image_url'],ENT_QUOTES) . "' WHERE `posts`.`post_id` = " . $_POST['post_id'] . "";
if (!mysqli_query($conn,$sql)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. Post updated.</p>";}
    } else {
        $sql = "SELECT * FROM `posts` WHERE `post_id` = " . $_POST['post_id'] . "";
        $result = mysqli_query($conn, $sql);
        $post = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    ?>
								<h2>Update Post</h2>
								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
												Title:<br>
												<textarea id="title" name="title" type="text"><?php echo htmlspecialchars_decode($post['title'], ENT_QUOTES); ?></textarea>
												<br><br>
												Image url:<br>
												<textarea id="image_url" name="image_url" type="text"><?php echo htmlspecialchars_decode($post['image_url'], ENT_QUOTES); ?></textarea>
												<br><br>
												<textarea name="content" class="tiny" label="hello"><?php echo htmlspecialchars_decode($post['content'], ENT_QUOTES); ?></textarea>
												<br>
												<input type="hidden" id="post_id" name="post_id" value="<?php echo $post['post_id']; ?>">
												<button class="button" type="submit" name="update_post" id="update_post" value="update_post">Submit</button>
								</form>
<?php }
}
include('footer.php'); ?>
</html>