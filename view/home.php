<main>
    <h1>Welcome to the Comments Application</h1>
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
    
    <h2>Posts</h2>
    <?php if (empty($comments)): ?>
        <p>No posts available.</p>
    <?php else: ?>
        <?php foreach ($comments as $comment): ?>
            <p><strong><?php echo $comment['username']; ?>:</strong> <?php echo $comment['comment']; ?>
            <br>Posted on: <?php echo $comment['posted_date']; ?>
            <?php if ($loggedin && $comment['user_id'] == $_SESSION['accountid']): ?>
                <a href="login_register.php?action=edit&id=<?php echo $comment['id']; ?>">Edit</a> | 
                <a href="login_register.php?action=delete&id=<?php echo $comment['id']; ?>">Delete</a>
            <?php endif; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
</main>
