<!DOCTYPE html>
	<html>
		<head>
			<title>Simple Form Application - PHP</title>
			<link rel="stylesheet" href="main.css">
		</head>
		<body>
			<main>
				<h1>User Input Form</h1>
				<form action="login_register.php" method="post">
					<fieldset>
						<legend>Enter Your Comments</legend>
						<label for="name">Name:</label>
						<input type="text" name="name" id="name" value = "<?php echo $userDisplay; ?>"><br>

						<label for="email">Email:</label>
						<input type="text" name="email" id="email" value = "<?php echo $email; ?>"><br>

				<label for="comments">Comments:</label><br>
				<textarea name="comment" id="comment" >
				 <?php echo $comment['comment']; ?>
				</textarea><br>
			   <input type="hidden" name ="id" value=<?php echo $comment['id']?>" ;>
				<input type="submit" name = "action" value="Update Comment" >
				</fieldset>
			</form>
		</main>
	</body>
	</html>
	