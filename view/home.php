<main>
    <h1>Welcome to the Comments Application</h1>
    <p>This is my version 4</p>
    <p>This is my verison 5 </p>
    <nav>
        <?php if ($loggedin): ?>
            <a href="login_register.php?action=makepost">Make a New Post</a> | 
            <a href="login_register.php?action=account">View Account</a> | 
            <a href="login_register.php?action=logout">Logout</a>
        <?php else: ?>
            <a href="login_register.php?action=loginform">Login</a> | 
            <a href="login_register.php?action=register">Register</a>
        <?php endif; ?>
    </nav>
		<?php echo $output; ?>
</main>
