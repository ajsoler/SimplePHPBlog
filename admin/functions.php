<?php 
//echo some array in nice way
function parray($array){
echo '<pre>'; print_r($array); echo '</pre>';}
//end of echo array in nice way

//Invoke full name of the user
function invoke_fullname($conn,$user_id){
$sql = "SELECT `first`,`last` FROM `users` WHERE `user_id` LIKE $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
mysqli_free_result($result);
echo $user['first']." ".$user['last'];}
//End Invoke full name of the user

//Start function validate user type
function validate_user_type($conn,$user_id,$user,$pass){
$sql = "SELECT `user_id`,`user`,`pass`,`type` FROM `users` WHERE `user_id` LIKE $user_id";
$result = mysqli_query($conn, $sql);
$validate = mysqli_fetch_assoc($result);
mysqli_free_result($result);
if(empty($validate)){echo "Error. Validation empty"; exit;}else{
	if ($user === $validate['user'] and $pass === $validate['pass']){	$_SESSION['type']=$validate['type']; }
				else{echo "Error. Pass or User NOT match."; exit;}}}
//Ends function validate user type

//Invoke posts
function invoke_posts($conn, $limit, $offset){
$sql = "SELECT * FROM `posts` ORDER BY `post_id` DESC LIMIT $limit,$offset";
$result = mysqli_query($conn, $sql);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
return($posts);}
//End invoking posts	

//Invoke post
function invoke_post($conn, $post_id){
$sql = "SELECT * FROM `posts` WHERE `post_id` = $post_id";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);
mysqli_free_result($result);
return($post);}
//End invoking post	

//Login Validation
function login_validation($conn,$user,$pass){
				global $error_user;
				global $error_pass;
				global $error_login;
    if (empty($user)) { $error_user = "User field empty"; } else {
    if (empty($pass)) { $error_pass = "Password field empty"; } else {
				if (preg_match('/\s/',$user)){ $error_user = "Username should not contain spaces."; } else {
				if (preg_match('/\s/',$pass)){ $error_pass = "Password should not contain spaces."; } else {
				if (!preg_match('/^[a-z]{3,10}[0-9]{0,4}$/',$user)){ $error_user = "Username must start with at least 3 letters max 10.<br>Only lowercase letters and numbers allowed max 4.<br>Max lenght 14 characters."; } else {
				if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pass)) { $error_pass = "
								Required at least one number<br>
								Required at least one letter<br>
								Required lenght 8-12 characters<br>
								Special Characters Allowed !@#$%";}else{		
					
					       $sql = "SELECT * FROM `users` WHERE user LIKE '" . $user . "'";
            $result = mysqli_query($conn, $sql);
            $array = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            if (empty($array)) {
                $error_login = "Error username not found";
            } else {
                if ($array['pass'] === $pass) {
                    $_SESSION['user_id'] = $array['user_id'];
																				$_SESSION['user'] = $array['user'];
                    $_SESSION['pass'] = $array['pass'];
                    header("Location:index.php");
																				exit;
                } else {
                    $error_login = "Incorrect password";
                }
            }
				}}}}}}
}
//End Login Validation

//Register Validation
function register_validation($conn,$user,$pass,$email){
				global $error_user;
				global $error_pass;
				global $error_email;
				global $error_register;
    if (empty($user)) { $error_user = "User field empty"; } else {
    if (empty($pass)) { $error_pass = "Password field empty"; } else {
				if (empty($email)) { $error_email = "Email field empty"; } else {
				if (preg_match('/\s/',$user)){ $error_user = "Username should not contain spaces."; } else {
				if (preg_match('/\s/',$pass)){ $error_pass = "Password should not contain spaces."; } else {
				if (preg_match('/\s/',$email)){ $error_email = "Email should not contain spaces."; } else {
				if (!preg_match('/^[a-z]{3,10}[0-9]{0,4}$/',$user)){ $error_user = "Username must start with at least 3 letters max 10.<br>Only lowercase letters and numbers allowed max 4.<br>Max lenght 14 characters."; } else {
				if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pass)) { $error_pass = "
				Required at least one number<br>
				Required at least one letter<br>
				Required lenght 8-12 characters<br>
				Special Characters Allowed !@#$%";}else{
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $error_email = "Email address is invalid."; }else{
					
$sql = "SELECT * FROM `users` WHERE user LIKE '".$user."'"; 
$result = mysqli_query($conn, $sql);
$array = mysqli_fetch_assoc($result);
mysqli_free_result($result);


   if(empty($array)){
    
         $sql = "INSERT INTO `users` (`user_id`, `user`, `pass`, `first`, `last`, `type`, `email`) VALUES ('NULL', '".$user."', '".$pass."', NULL, NULL, 'member', '".$email."')";
         mysqli_query($conn, $sql);
         $_SESSION['user'] = $user;
         $_SESSION['pass'] = $pass;
         header( "Location:index.php" );}
   
   else{ $error_register = "Error username taken"; }

            }
				}}}}}}}}
}
//End Register Validation

//Insert comment
function add_comment($conn, $comment, $user, $post_id){
$sql = "INSERT INTO `comments` (`comment_id`, `comment`, `user`, `post_id`) VALUES (NULL, '".htmlspecialchars($comment,ENT_QUOTES)."', '$user', '$post_id')";
if (!mysqli_query($conn,$sql)) { echo("SQL Error description: " . mysqli_error($conn)); }
}
//End Insert comment

//Invoke post comments
function invoke_post_comments($conn,$post_id,$load){
$sql = "SELECT * FROM `comments` WHERE `post_id`=$post_id ORDER BY `comment_id` DESC LIMIT $load";
$result = mysqli_query($conn, $sql);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
return($comments);}
//End invoking posts	

//Count number of comments
function count_post_comments($conn, $post_id){
$sql = "SELECT COUNT(comment_id) FROM comments WHERE post_id = $post_id";
$result = mysqli_query($conn, $sql);
$number = mysqli_fetch_row($result);
mysqli_free_result($result);
echo $number[0];
}
//End count number of comments	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>