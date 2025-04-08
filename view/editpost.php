<main>
    <h1>Edit Your Post</h1>
    <form action="login_register.php" method="post">
        <label for="comment">Your Comment:</label><br>
        <textarea name="comment" id="comment" maxlength="255" >
			<?php echo $editComment;?>
		</textarea><br>
        <input type="submit" name="action" value="Update Comment">
		 <input type="hidden" name = "id" value="<?php echo $commentId ;?>">
    </form>
</main>
