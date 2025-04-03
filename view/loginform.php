<main>
    <h1>Login Form</h1>
    <form action="login_register.php" method="post">
        <p><?php echo $error; ?></p>
        <label>Username:</label>
        <input type="text" name="username" value=""><br>
        <label>Password:</label>
        <input type="password" name="password"><br>
        <input type="submit" name="action" value="Login"><br>
    </form>
</main>
