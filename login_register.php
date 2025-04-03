<?php
session_start();
include("model/functions.php");

//Check if this client is authenticated (logged in)
if(isset($_SESSION['loggedin']))
{//The $_SESSION array is only assigned values after successful 
//authentication, so $_SESSION['loggedin'] will only be set if the user 
//if the user is already logged in
//Assign the data stored in the $_SESSION array to local variables
	$loggedin = $_SESSION['loggedin'];
	$accountid = $_SESSION['accountid'];
	$userDisplay = $_SESSION['userDisplay'];
	$username = $_SESSION['username'];
	$email = $_SESSION['email'];
	//Set the menu options for authenticated users
	$menu = "<a href='login_register.php?action=account'>My Account</a> | <a href='login_register.php?action=logout'>Logout</a>";
}
else
{//User is not authenticated (not logged in)
	$loggedin = FALSE;
	//Set the menu options for non-authenticated users
	$menu = "<a href='login_register.php?action=loginform'>Login</a> | <a href='login_register.php?action=register'>Register</a>";
}

//Get the user 'action'
//Check the POST array for a value with the name 'action' (form submission)
$action = filter_input(INPUT_POST, 'action');
//If NULL - nothing found in POST array - check the GET array (URL submission)
if($action == NULL)
	$action = filter_input(INPUT_GET, 'action');
$error="";

if ($action == 'register') {
    include('view/registerform.php');
} elseif ($action == 'Submit Registration') {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $email = filter_input(INPUT_POST, 'email');
    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    
    if (notEmptyAccount($username, $password, $email, $fname, $lname)) {
        if (checkUsername($username)) {
            addAccount($username, $password, $email, $fname, $lname);
            header("Location: login_register.php?action=loginform");
        } else {
            $error = "Username is not available.";
            include('view/registerform.php');
        }
    } else {
        $error = "All fields are required.";
        include('view/registerform.php');
    }
} elseif ($action == 'loginform') {
    include('view/loginform.php');
} elseif ($action == 'Login') {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $account = processLogin($username, $password);
    if ($account != NULL) {
        $_SESSION['loggedin'] = true;
        $_SESSION['accountid'] = $account['id'];
        $_SESSION['username'] = $account['username'];
        $_SESSION['email'] = $account['email'];
        $_SESSION['userDisplay'] = $account['fname'] . ' ' . $account['lname'];
        header("Location: login_register.php");
    } else {
        $error = "Incorrect login.";
        include('view/loginform.php');
    }
} elseif ($action == 'logout') {
    session_destroy();
    header("Location: login_register.php");
} elseif ($action == 'account') {
    $account = getAccountDetails($_SESSION['accountid']);
    include('view/account.php');
} elseif ($action == 'makepost') {
    include('view/makepost.php');
} elseif ($action == 'Submit Comment') {
    $comment = filter_input(INPUT_POST, 'comment');
    addComment($_SESSION['accountid'], $comment);
    header("Location: login_register.php");
} elseif ($action == 'delete') {
    $commentId = filter_input(INPUT_GET, 'id');
    $comment = getCommentById($commentId);
    if ($comment['user_id'] == $_SESSION['accountid']) {
        deleteComment($commentId);
    }
    header("Location: login_register.php");
} elseif ($action == 'edit') {
    $commentId = filter_input(INPUT_GET, 'id');
    $comment = getCommentById($commentId);
    include('view/edit.php');
} elseif ($action == 'Update Comment') {
    $commentId = filter_input(INPUT_POST, 'id');
    $newComment = filter_input(INPUT_POST, 'comment');
    updateComment($commentId, $newComment);
    header("Location: login_register.php");
} else {
    $comments = getAllComments();
    include('view/home.php');
}
?>
