<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=ipa1';
$dbuser = 'root';
$dbpass = '';
$db = new PDO($dsn, $dbuser, $dbpass);

// Functions related to user accounts

function notEmptyAccount($username, $password, $email, $fname, $lname){
		//Not every function deals with DB connections
		//This function checks for empty variables and is used for form validation
		//returns true if non of the variables (parameters) are empty or returns false if one or more of them are empty
		if(empty($username) OR empty($password) OR empty($email) OR empty($fname) OR empty($lname)){
			return false;
	}
		else {
			return true;
		}
	}
function addAccount($username, $password, $email, $fname, $lname) {
    global $db;
    $query = 'INSERT INTO accounts (username, password, email, fname, lname) VALUES (:username, :password, :email, :fname, :lname)';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
    $statement->bindValue(':email', $email);
    $statement->bindValue(':fname', $fname);
    $statement->bindValue(':lname', $lname);
    $statement->execute();
    $statement->closeCursor();
}

function checkUsername($username) {
    global $db;
    $query = 'SELECT COUNT(*) FROM accounts WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $result = $statement->fetchColumn();
    $statement->closeCursor();
    return $result == 0;
}

function processLogin($username, $password) {
    global $db;
    $query = 'SELECT * FROM accounts WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $account = $statement->fetch();
    $statement->closeCursor();
    if ($account && password_verify($password, $account['password'])) {
        return $account;
    }
    return NULL;
}

function getAccountDetails($accountid) {
    global $db;
    $query = 'SELECT * FROM accounts WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $accountid);
    $statement->execute();
    $account = $statement->fetch();
    $statement->closeCursor();
    return $account;
}

// Functions related to comments
function addComment($user_id, $comment) {
    global $db;
    $query = 'INSERT INTO comments (user_id, comment,posted_date) VALUES (:user_id, :comment, CURRENT_TIMESTAMP)';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':comment', $comment);
    $statement->execute();
    $statement->closeCursor();
}

function getAllComments() {
    global $db;
    $query = 'SELECT c.id, c.comment, c.user_id, c.posted_date, a.username, a.fname, a.lname FROM comments c JOIN accounts a ON c.user_id = a.id ORDER BY c.posted_date DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    $comments = $statement->fetchAll();
    $statement->closeCursor();
    return $comments;
}

function getCommentById($id) {
    global $db;
    $query = 'SELECT * FROM comments WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $comment = $statement->fetch();
    $statement->closeCursor();
    return $comment;
}

function updateComment($id, $comment) {
    global $db;
    $query = 'UPDATE comments SET comment = :comment WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':comment', $comment);
    $statement->execute();
    $statement->closeCursor();
}

function deleteComment($id) {
    global $db;
    $query = 'DELETE FROM comments WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
}
?>
