<?php
class Session {
	// Start session
	public function start(){
		session_start();
	}

	// Save session
	public function send($user){
		$_SESSION['user'] = $user;
	}
	// Get data session
	public function get(){
		if (isset($_SESSION['user']))
		{
			$user = $_SESSION['user'];
		}else {
			$user = '';
		}
		return $user;
	}

	public function destroy(){
		session_destroy();
	}
}
?>