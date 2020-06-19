<!doctype html>
<html>
<?php include('header.php');
// Delete an entry code
if (isset($_POST['delete'])) {
    $q_delete = "DELETE FROM `posts` WHERE `post_id` = ${_POST['delete']}";
    mysqli_query($conn, $q_delete);
    header("Location:index.php");}
// End delete entry code
	
//invoke posts depending on admin or poster
if ( $_SESSION[ 'type' ] == 'admin' ) {
	$sql = "SELECT * FROM `posts` ORDER BY post_id DESC";
}
if ( $_SESSION[ 'type' ] == 'poster' ) {
	$sql = "SELECT * FROM `posts` WHERE `user_id` = ${_SESSION['user_id']} ORDER BY post_id DESC";
}
$result = mysqli_query( $conn, $sql );
$posts = mysqli_fetch_all( $result, MYSQLI_ASSOC );
mysqli_free_result( $result );
//end invoke posts depending on user
?>
	<h2>Welcome <?php invoke_fullname($conn,$_SESSION['user_id']); ?> [ <?php echo $_SESSION['user']; ?> ]</h2>
		<h3>Posts</h3>

		<?php foreach ($posts as $post): ?>
	<div class="clearfix">
					<div>
					<form action="update_post.php" method="post">
						<input type="hidden" name="user_id" value="<?php echo $post['user_id']; ?>">
						<button class="button" type="submit" name="post_id" value="<?php echo $post['post_id']; ?>">Update</button>
					</form>
					</div>
					<div>
					<form action="index.php" method="post">
						<input type="hidden" name="user_id" value="<?php echo $post['user_id']; ?>">
						<button class="button" type="submit" name="delete" value="<?php echo $post['post_id']; ?>">Delete</button>
					</form>
					</div>
					<div class="postInfo">[ <?php echo $post['date']; ?> ] <?php echo $post['title']; ?></div>
	</div>
	<?php endforeach; ?>
	
	
	
	

<?php include('footer.php'); ?>
</html>