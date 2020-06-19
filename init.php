<?php
if(isset($_POST['init'])){

//Store log in infor into variables
$servername = "${_POST['server']}";
$serveruser = "${_POST['user']}";
$serverpassword = "${_POST['pass']}";
$sb_admin_user = "${_POST['adminuser']}";
$sb_admin_password = "${_POST['adminpass']}";
$sb_admin_name = "${_POST['adminname']}";
$sb_admin_last = "${_POST['adminlast']}";


$conn = mysqli_connect($servername, $serveruser, $serverpassword);
if ( !$conn ) {echo "Connection Fail" . mysqli_connect_error();}
$sql = "select schema_name from information_schema.schemata where schema_name = 'simplephpblog';";
$result = mysqli_query($conn,$sql);
$data = mysqli_fetch_assoc($result);
$count = count((array) $data);
if($count > 0){ echo "Database Exists. Please delete 'simplephpblog' database and reinstall."; exit;} else {

$query_database = "CREATE DATABASE simplephpblog;";
if (!mysqli_query($conn,$query_database)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. SimpleBlog Database Created.</p>";}

$conn = mysqli_connect($servername, $serveruser, $serverpassword, 'simplephpblog');

$query_users = "CREATE TABLE `users` (
    `user_id` int(20) NOT NULL,
    `user` varchar(20) NOT NULL,
    `pass` varchar(20) NOT NULL,
    `first` varchar(20) DEFAULT NULL,
    `last` varchar(20) DEFAULT NULL,
    `type` varchar(20) NOT NULL DEFAULT 'member',
    `email` varchar(50) DEFAULT NULL
  );";
if (!mysqli_query($conn,$query_users)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. SimpleBlog Users Table Created.</p>";}

$query_posts = "CREATE TABLE `posts` (
    `post_id` int(20) NOT NULL,
    `title` varchar(255) DEFAULT NULL,
    `youtube` varchar(255) DEFAULT NULL,
    `content` text,
    `user_id` int(20) DEFAULT NULL,
    `image_url` varchar(255) DEFAULT NULL,
    `date` date NOT NULL
  );";
if (!mysqli_query($conn,$query_posts)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. SimpleBlog Posts Table Created.</p>";}

$query_comments = "CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` text,
  `user` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL
);";
if (!mysqli_query($conn,$query_comments)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. SimpleBlog Comments Table Created.</p>";}

$query_pk_users = "ALTER TABLE `users`
ADD PRIMARY KEY (`user_id`),
ADD UNIQUE KEY `user` (`user`);";
if (!mysqli_query($conn,$query_pk_users)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. Primary key table users created.</p>";}

$query_pk_posts = "ALTER TABLE `posts`
ADD PRIMARY KEY (`post_id`),
ADD KEY `user_id` (`user_id`);";
if (!mysqli_query($conn,$query_pk_posts)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. Primary key table posts created.</p>";}

$query_pk_comments = "ALTER TABLE `comments`
ADD PRIMARY KEY (`comment_id`),
ADD KEY `post_id` (`post_id`);";
if (!mysqli_query($conn,$query_pk_comments)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. Primary key table comments created.</p>";}

$query_ai_users = "ALTER TABLE `users`
MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
if (!mysqli_query($conn,$query_ai_users)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. Auto id increment table users.</p>";}

$query_ai_posts = "ALTER TABLE `posts`
MODIFY `post_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
if (!mysqli_query($conn,$query_ai_posts)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. Auto id increment table posts.</p>";}

$query_ai_comments = "ALTER TABLE `comments`
MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
if (!mysqli_query($conn,$query_ai_comments)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. Auto id increment table comments.</p>";}

$query_sp_admin = "INSERT INTO `users` (`user_id`, `user`, `pass`, `first`, `last`, `type`, `email`) VALUES
(NULL, '".$sb_admin_user."', '".$sb_admin_password."', '".$sb_admin_name."', '".$sb_admin_last."', 'admin', NULL);";
if (!mysqli_query($conn,$query_sp_admin)) { echo("SQL Error description: " . mysqli_error($conn)); }
else{	echo "<p>Success. Simple PHP Blog Admin Created.</p>";}

$myfile = fopen("admin/config.php", "w") or die("Unable to open file!");
$txt = '<?php
//Store log in infor into variables
		$servername = "'.$servername.'";
		$serveruser = "'.$serveruser.'";
		$serverpassword = "'.$serverpassword.'";
		$serverdatabase = "simplephpblog";

		// Create connection
		$conn = mysqli_connect( $servername, $serveruser, $serverpassword, $serverdatabase );
		
		// Display error message if fails;
		if ( !$conn ) {echo "Connection Fail" . mysqli_connect_error();}

//End  connection
?>
';
fwrite($myfile, $txt);
fclose($myfile);
echo "<p>Success. Simple PHP Blog Config.php file created.</p>";
}
exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Simple PHP Blog Initialization</title>
</head>

<body>
<h3>Simple PHP Blog Initialization</h3>
<hr>
<form method="POST">
<p>Fill the info below for the server database config</p>
<p>MySQL_ServerName   <input type="text" value="localhost" name="server"></p>
<p>MySQL_Username   <input type="text" value="admin" name="user"></p>
<p>MySQL_Password   <input type="text" value="password" name="pass"></p>
<hr>
<p>Fill the info below for simple blog admin</p>
<p>Simple Blog Admin User  <input type="text" value="myuser" name="adminuser"></p>
<p>Simple Blog Admin Password  <input type="text" value="mypass" name="adminpass"></p>
<p>Simple Blog Admin First Name  <input type="text" value="myName" name="adminname"></p>
<p>Simple Blog Admin Last Name  <input type="text" value="myLast" name="adminlast"></p>
<p><input type="submit" value="Initialize" name="init"></p>


</form>


</body>

</html>