<!doctype html>
<html>
<?php include('header.php'); 
	
if(empty($_SESSION['user_id'])
			or empty($_SESSION['user'])
			or empty($_SESSION['pass'])){header("Location: login.php"); exit;}
else{ 
				if($_SESSION['type']==='admin' or $_SESSION['type']==='poster' or $_SESSION['type']==='member'){}
				else{echo "Access Denied. User not admin or poster."; exit;}
				}		
	
if(isset($_GET['post_id'])){
	$post = invoke_post($conn, $_GET['post_id']);
	} else { echo "Access denied. A post must be selected"; exit;}
	
if(isset($_POST['add_comment'])){
	 $comment_stripped = strip_tags($_POST['comment']);
		add_comment($conn, $comment_stripped,$_SESSION['user'],$_GET['post_id']);
}
	?>
<div class="main">
<div class="left-side">
	
	<div style="padding: 5px 5px;" class="clearfix">
	<div class="title-right">
 Post <?php echo $post['post_id']; ?>
	</div>
 <div class="card-content">
	<div style="text-align: center;"><img class="post-image" src="<?php echo htmlspecialchars_decode($post['image_url'], ENT_QUOTES); ?>"></div>
	<h3><?php echo htmlspecialchars_decode($post['title'], ENT_QUOTES); ?></h3>
	<?php echo htmlspecialchars_decode($post['content'], ENT_QUOTES); ?>
	</div>
	</div>
	
	<div style="padding: 5px 5px;" class="clearfix">
 <div class="comment-content">
	<?php $comments = invoke_post_comments($conn, $_GET['post_id'], 30); ?>
	<h4>Comments</h4>
	<?php foreach($comments as $comment): ?>
	<p><b><?php echo $comment['user']; ?>:</b> <?php echo $comment['comment']; ?></p>
	<?php endforeach; ?>	
	</div>
	</div>
	
	
	<div style="padding: 5px 5px;" class="clearfix">
 <div class="comment-content">
	<h4>Add Comment</h4>
	<div class="add-comment">
	<form action="post.php?post_id=<?php echo $_GET['post_id'] ?>" method="post">
	<input disabled  maxlength="3" size="3" value="500" id="counter">
	<textarea onkeyup="textCounter(this,'counter',500);" id="message" name="comment"></textarea>
	<button class="button" type="submit" name="add_comment" value="add_comment">Add</button>
	</form>	
	</div>
	</div>
	</div>
	
	
	
	
	
	

</div><!-- Here ends left-panel div-->
				
<!-- Starts Right Panel-->
<div class="right-side clearfix">
<?php include('right_panel.php')?>
</div>
<!-- Ends right-panel-->

	

<!-- Here ends main content div--></div>
<script>
function textCounter(field,field2,maxlimit)
{
 var countfield = document.getElementById(field2);
 if ( field.value.length > maxlimit ) {
  field.value = field.value.substring( 0, maxlimit );
  return false;
 } else {
  countfield.value = maxlimit - field.value.length;
 }
}
</script>
	
<?php include('footer.php'); ?>
</html>