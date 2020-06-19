<!doctype html>
<html>
<?php include('header.php');
// Call posts and store them into varriablearray
$posts = invoke_posts($conn, 0, 8);
?>
<div class="main">
<div class="left-side">	
	
	<div class="grid">
	<div class="grid-sizer"></div>
	<?php foreach($posts as $post): ?>			
						<div class="grid-item">
							
						<div class="card clearfix"><!-- This is the wraper -->
							<img class="card-image" src="<?php echo htmlspecialchars_decode($post['image_url'], ENT_QUOTES); ?>">
							<!-- Starts card content -->
							<div class="card-content">	
							<h3><?php echo htmlspecialchars_decode($post['title'], ENT_QUOTES); ?></h3>
							<p><?php echo substr(htmlspecialchars_decode($post['content'], ENT_QUOTES),0,400); ?>...</p>
							<div class="read-more"><a href="post.php?post_id=<?php echo $post['post_id']; ?>">Read More</a></div>
							<div class="clearfix" style="font-size: .8em;">
								<div style="float: left;">[ <?php echo $post['date']; ?> ] [ <?php invoke_fullname($conn,$post['user_id']); ?> ]</div>
								<div style="float: right;">[ Comments <?php count_post_comments($conn, $post['post_id']); ?> ]</div>
							</div>
							</div>
							<!-- Ends card content -->
						</div><!-- Ends the wraper -->
					</div>
	<?php endforeach; ?>			
	</div>
	
</div><!-- Here ends left-panel div-->
				
	
<div class="right-side clearfix">
	
<?php include('right_panel.php')?>
	


	

	
	

	

	
	

</div><!-- Here ends right-panel div-->
</div><!-- Here ends main content div-->
<?php include('footer.php'); ?>
</html>