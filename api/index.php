<?php

//File PHP dang nhap va su dung database de dang nhap va dang ki tai khoan

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type');

$text;

require_once("DB.php");

$db = new DB('103.57.220.117', 'chatroom', 'root', '@Kh27021997');

// $_SERVER: get the request method of this page
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
	// POST: push the data to the server
	
	if ($_GET['url'] == 'signup') {
		// The user is trying to sign up
		
		// hangling the request file 
		/*
				* T H I S  S H O U L D  B E  M O D I F I E D !!! *
				* T H I S  S H O U L D  B E  M O D I F I E D !!! *
				* T H I S  S H O U L D  B E  M O D I F I E D !!! *
				* T H I S  S H O U L D  B E  M O D I F I E D !!! *
				* T H I S  S H O U L D  B E  M O D I F I E D !!! *
		*/
		$postbody = file_get_contents('php://input');
		$postbody = json_decode($postbody);
		
		$username = $postbody->username;
		$password = $postbody->password;
		$displayname = $postbody->displayname;
		$email = 'admin@chatroom.com';
		
		// check the user info in the database\
		if (!$db->query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))){
			if (!$db->query('SELECT displayname FROM users WHERE displayname=:displayname', array(':displayname'=>$displayname))) {
				if (strlen($username) >= 3 && strlen($username) <= 32) {
					if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
						if (strlen($password) >= 3 && strlen($password) <= 60) {
							// The code that update the user info in the database
							$db->query('INSERT INTO users VALUES (NULL, :username, :password, :displayname, :email)', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':displayname'=>$displayname, ':email'=>$email));

							echo '{ "Success" : "Created user" }';
							http_response_code(200);
						} else {
							echo '{ "Error" : "Invalid password", "Extra" : "Incorrect length" }';
							http_response_code(401);
						}
					} else {
						echo '{ "Error" : "Invalid username" }';
						http_response_code(401);
					}
				} else {
					echo '{ "Error" : "Invalid username", "Extra" : "Incorrect length" }';
					http_response_code(401);
				}
			} else {
				echo '{ "Error" : "displayname in use" }';
				http_response_code(401);
			}
		} else {
			echo '{ "Error" : "User already exists" }';
			http_response_code(401);
		}
	} else if ($_GET['url'] == 'auth') {
		// The user is trying to sign in
		
		$postbody = file_get_contents('php://input');
		$postbody = json_decode($postbody);
		
		$username = $postbody->username;
		$password = $postbody->password;
		
		if ($db->query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
			if (password_verify($password, $db->query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {
				$cstrong = True;
				$token = bin2hex(openssl_random_pseudo_bytes(64, $sctrong));
				$user_id = $db->query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
				$db->query('INSERT INTO login_tokens VALUES (NULL, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
				setcookie('SNID', $token, time() + 60 * 60 * 24 * 7, '/', "", NULL, False);
				setcookie('SNID_', 1, time() + 60 * 60 * 24 * 3, '/', "", NULL, False);
				
				echo '{ "Success" : "Login Successfully" }';
				http_response_code(200);
			} else {
				echo '{ "Error" : "Password incorrect" }';
				http_response_code(401);
			}
		} else {
			echo '{ "Error" : "User not registered" }';
			http_response_code(401);
		}
	} else if ($_GET['url'] == 'getuser') {
		
		$postbody = file_get_contents('php://input');
		$postbody = json_decode($postbody);
		$token = $postbody->cookie;

		if ($db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))) {
			$text = $token;
			$user = $db->query('SELECT users.username, users.displayname FROM users, login_tokens WHERE token=:token AND login_tokens.user_id=users.id', array(':token'=>sha1($token)))[0];

			echo '{"username": "'.$user['username'].'", "displayname" : "'.$user['displayname'].'"}';
			http_response_code(200);

		} else {
			echo '{"Error" : "Not found user", "cookie" : "'.$token.'"}';
			http_response_code(401);
		}
		
	} else if ($_GET['url'] == 'logout') {
		
		$postbody = file_get_contents('php://input');
		$postbody = json_decode($postbody);
		$token = $postbody->cookie;
		
		if ($db->query('SELECT id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))) {
			$db->query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)));
			echo '{ "Success" : "Delete cookie succesfully" }';
			http_response_code(200);
		} else {
			echo '{ "Error" : "Fail deleting cookie" }';
			http_response_code(401);
		}
	}
	
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	// GET: get the data from the server
	
	if ($_GET['url'] == 'test') {
		echo '{ "Success" : "Test successed" }';
		http_response_code(200);
	} else if ($_GET['url'] == 'testcookie') {
		$text = $_COOKIE['SNID'];
		http_response_code(200);
	}
	
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
	// DELETE: remove the data from the database
	
	
}

?>
