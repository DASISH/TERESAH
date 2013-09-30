<?php
	class User {
		function __construct() {
			#Gettings globals
			global $DB;
			if(!isset($DB)) { exit(); }
			$this->DB = $DB;
		}
		function login($post) {
			$pw = hash('sha256', $post["password"]);
			try {
				$req = $this->DB->prepare("SELECT name as Name, mail as Mail, user_uid as UID FROM user WHERE login = ? AND password = ?");
				$req->execute(array($post["user"], $pw));    
			} catch (Exception $e) {
				Die('Need to handle this error. $e has all the details');
			}
			
			if($req->rowCount() == 1) {
				return array("signin" => true, "data" => $req->fetch(PDO::FETCH_ASSOC));
			} else {
				return array("signin" => false);
			}

		}
		function signup($post, $id = false) {
			if(isset($post["mail"]) && isset($post["password"]) && isset($post["name"]) && isset($post["user"])) {
				$req = "INSERT INTO user VALUES (NULL, ?, ? , ? , ? )";
				$req = $this->DB->prepare($req);
				$req->execute(array($post["name"], $post["mail"], $post["user"], hash("sha256", $post["password"])));
				
				if($req->rowCount() == 1) {
					if($id == true) {
						return $this->DB->lastInsertId();
					} else {
						return array("Success" => "You have now signed up");
					}
				} else {
					return array("Error" => "Error during signin up. Please contact DASISH or retry.");
				}
			} else {
				return array("Error" => "A field is missing");
			}
		}
		
		function oAuthLogin($data, $provider) {
			//uid
			$data = (array) $data;
			if(!isset($data["name"])) {
				$data["name"] = $data["nickname"];
			}
			if(!isset($data["email"])) {
				$data["email"] = $data["nickname"];
			}
			$req = $this->DB->prepare("SELECT u.name as Name, u.mail as Mail, u.user_uid as UID FROM user_oauth uo, user u WHERE u.user_uid = uo.user_uid AND uo.provider = ? AND uo.oauth_user_uid = ?");
			$req->execute(array($provider, $data["uid"]));
			if($req->rowCount() == 1) {
				$d = $req->fetch(PDO::FETCH_ASSOC);
				$_SESSION["user"] = array("id" => $d["UID"], "name" => $d["Name"], "mail" => $d["Mail"]);
				return array("signin" => true, "data" => $d);
			} else {
				$sign = $this->signup(array("mail" => $data["email"], "name" => $data["name"], "user" => $data["email"], "password" => time()), true);
				if($sign > 0) {
					$req = $this->DB->prepare("INSERT INTO user_oauth VALUES (NULL, ?, ?, ?)");
					$req->execute(array($provider, $sign, $data["uid"]));
					$_SESSION["user"] = array("id" => $sign, "name" => $data["name"], "mail" => $data["email"]);
					return array("signin" => true, "data" => array("UID" => $sign, "Name" => $data["name"], "Mail" => $data["email"]));
				}
			}
		}
		
		function oAuth2($GET, $server, $return = false) {
			switch($server) {
				case "facebook":
					$provider = new League\OAuth2\Client\Provider\Facebook(array(
						'clientId'  =>  '266150806749677',
						'clientSecret'  =>  'f1427c93991b383c018e534cd8e68859',
						'redirectUri'   =>  'http://debian-machine.com/API/oAuth/Facebook'
					));
					break;
				case "google":
					$provider = new League\OAuth2\Client\Provider\Google(array(
						'clientId'  =>  'OWE5zF6p7HzgnMCzMKI3w',
						'clientSecret'  =>  'NHFxk3O4lNsi5oTPw5rb68r3SS8FtLeG4DdkOp7yCs',
						'redirectUri'   =>  'http://debian-machine.com/API/oAuth/Twitter'
					));
					break;
				case "github":
					$provider = new League\OAuth2\Client\Provider\Github(array(
						'clientId'  =>  '032cdde9e2dd39d6a957',
						'clientSecret'  =>  '8aa4bd7bf3271cf5aaa33d32471877b96e6aeac9',
						'redirectUri'   =>  'http://debian-machine.com/API/oAuth/Github'
					));
					break;
			}

			if ( ! isset($GET['code'])) {

				// If we don't have an authorization code then get one
				if($return == true) {
					if(isset($GET["callback"])) {
						$_SESSION["callback"] = $GET["callback"];
					} else {
						$_SESSION["callback"] = false;
					}
					return array("popup" => $provider->authorize(array(), $return), "callback" => $_SESSION["callback"]);
				}
				$provider->authorize(array(), $return);

			} else {

				try {

					// Try to get an access token (using the authorization code grant)
					$t = $provider->getAccessToken('authorization_code', array('code' => $GET['code']));

					try {

						// We got an access token, let's now get the user's details
						$userDetails = $provider->getUserDetails($t);
						$d = $this->oAuthLogin($userDetails, $server);
						if(isset($_SESSION["callback"])) {
							$d["Location"] = $_SESSION["callback"];
						}
						return $d;
						//return $userDetails;

					} catch (Exception $e) {
						print $e;

						// Failed to get user details

					}

				} catch (Exception $e) {

					// Failed to get access token
					print $e;
				}
			}
		}
		function oAuth1($GET, $server) {
			switch($server) {
				case "twitter":
					
					$server = new League\OAuth1\Client\Server\Twitter(array(
						'identifier'  =>  'OWE5zF6p7HzgnMCzMKI3w',
						'secret'  =>  'NHFxk3O4lNsi5oTPw5rb68r3SS8FtLeG4DdkOp7yCs',
						'callback_uri'   =>  'http://debian-machine.com/API/oAuth/Twitter'
					));
					
					break;
			}
			if (isset($GET['user'])) {

				// Check somebody hasn't manually entered this URL in,
				// by checkign that we have the token credentials in
				// the session.
				if ( ! isset($_SESSION['token_credentials'])) {
					echo 'No token credentials.';
					exit(1);
				}

				// Retrieve our token credentials. From here, it's play time!
				$tokenCredentials = unserialize($_SESSION['token_credentials']);

				// // Below is an example of retrieving the identifier & secret
				// // (formally known as access token key & secret in earlier
				// // OAuth 1.0 specs).
				// $identifier = $tokenCredentials->getIdentifier();
				// $secret = $tokenCredentials->getSecret();

				// Some OAuth clients try to act as an API wrapper for
				// the server and it's API. We don't. This is what you
				// get - the ability to access basic information. If
				// you want to get fancy, you should be grabbing a
				// package for interacting with the APIs, by using
				// the identifier & secret that this package was
				// designed to retrieve for you. But, for fun,
				// here's basic user information.
				$user = $server->getUserDetails($tokenCredentials);
				var_dump($user);

			// Step 3
			} elseif (isset($GET['oauth_token']) && isset($GET['oauth_verifier'])) {

				// Retrieve the temporary credentials from step 2
				$temporaryCredentials = unserialize($_SESSION['temporary_credentials']);

				// Third and final part to OAuth 1.0 authentication is to retrieve token
				// credentials (formally known as access tokens in earlier OAuth 1.0
				// specs).
				$tokenCredentials = $server->getTokenCredentials($temporaryCredentials, $GET['oauth_token'], $GET['oauth_verifier']);

				// Now, we'll store the token credentials and discard the temporary
				// ones - they're irrevelent at this stage.
				unset($_SESSION['temporary_credentials']);
				$_SESSION['token_credentials'] = serialize($tokenCredentials);
				session_write_close();

				// Redirect to the user page
				header("Location: http://{$_SERVER['HTTP_HOST']}/?user=user");
				exit;

			// Step 2.5 - denied request to authorize client
			} elseif (isset($GET['denied'])) {
				echo 'Hey! You denied the client access to your Twitter account! If you did this by mistake, you should <a href="?go=go">try again</a>.';

			// Step 2
			} elseif (isset($GET['go'])) {

				// First part of OAuth 1.0 authentication is retrieving temporary credentials.
				// These identify you as a client to the server.
				$temporaryCredentials = $server->getTemporaryCredentials();

				// Store the credentials in the session.
				$_SESSION['temporary_credentials'] = serialize($temporaryCredentials);
				session_write_close();

				// Second part of OAuth 1.0 authentication is to redirect the
				// resource owner to the login screen on the server.
				$server->authorize($temporaryCredentials);

			// Step 1
			}
		}
	}
	$user = new User();
?>