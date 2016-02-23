<?php
	session_start();
	function isLoggedIn(){
		return $_SESSION['username'] != null;
	}
	
	function isAdmin(){
		if(isLoggedIn()){
			global $user;
			if($user == null){
				$qu = "SELECT * FROM shopping_users WHERE username = '{$_SESSION['username']}'";
				$r = mysqli_query($GLOBALS['dbc'],$qu);
				$user = mysqli_fetch_array($r);
			}
			return $user['admin'];
		}
		else{
			return false;
		}
	}
	
	function isVendor(){
		if(isLoggedIn()){
			global $user;
			if($user == null){
				$qu = "SELECT * FROM shopping_users WHERE username = '{$_SESSION['username']}'";
				$r = mysqli_query($GLOBALS['dbc'],$qu);
				$user = mysqli_fetch_array($r);
			}
			return $user['vendor'];
		}
		else{
			return false;
		}
	}
	
	function getUser(){
		global $user;
		$qu = "SELECT * FROM shopping_users WHERE username = '{$_SESSION['username']}'";
		$r = mysqli_query($GLOBALS['dbc'],$qu);
		$user = mysqli_fetch_array($r);
	}
?>