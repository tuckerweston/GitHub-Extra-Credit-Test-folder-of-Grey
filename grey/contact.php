<?php include 'include/config.php'; ?>
<?php include 'include/header.php'; ?>
<h1>Contact US!</h1> 
<p>Your information is so important to us!</p>
<?php

if(isset($_POST['Name']))
{
	//echo $_POST['Name'];
	/*
	echo '<pre>'; 
	var_dump($_POST);
	echo '</pre>'; 
	*/
	
	$to = 'tuckerweston@hotmail.com';
	$replyto = $_POST['Email'];
	$subject = 'Test Email from ' . $_POST['Name'];
	$today = date("F , Y, g:i a");         // March 10, 2001, 5:16 pm
	$message = $_POST['Comments'];
	$headers = 'From: noreply@tucker-weston.com' . PHP_EOL .
    	'Reply-To: ' . $replyto . PHP_EOL .
    	'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);
	echo "Thank you for your message!"; 
	
}else{
	
	echo 
	'
	<form action="' . THIS_PAGE . '" method="post">
		<p>
			<label for="Name">Name:</label>
			<input type="text" id="Name" name="Name" required="required" title="We need your name" placeholder="Enter your Name" />
		</p>
		<p>
			<label for="Email">Email:</label>
			<input type="email" id"Email" name="Email" required="required" title="We need your email" placeholder="Enter your Email" />
		</p>
		<p>
			<label for="Comments">Comments:</label>
			<textarea type="text" 
				   id="Comments" 
				   name="Comments" 
				   required="required" 
				   title="We need your comments" 
				   placeholder="Comments" 
			></textarea>	  
		</p>
		<input type="submit" value="Click to submit!" />
	</form>
	';
}

?>
<?php include 'include/footer.php'; ?>