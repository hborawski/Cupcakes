<?php
	class loginChecker{
		public function checkLogin($user,$pass,$loginType)
		include 'CONST.php';
		//$user = $_POST['email'];
		//$pass = $_POST['password'];
		//$loginType = $_POST['type'];

		$login = false;
		mysql_connect($mysql_host,$mysql_user,$mysql_password);
		if ($loginType == 1){
			@mysql_select_db($mysql_database);
			$query = "SELECT * FROM managers WHERE Username='$user' AND Password='$pass'";
			$result = mysql_query($query) or die("No such user");

			$count = mysql_num_rows($result);

			if($count == 1){
				session_start();
				$perm = true;
				$login = true;
				$_SESSION['permission'] = $perm;
			}
		}elseif($loginType==0){
			@mysql_select_db($mysql_database);
			$query = "SELECT * FROM users WHERE Email='$user' AND Password='$pass'";
			$result = mysql_query($query) or die("No such user");

			$count = mysql_num_rows($result);
			if($count ==1){
				session_start();
				$perm = true;
				$login = true;
				$_SESSION['user']= $perm;
			}
		}
		return $login;

	}
}

		//header("location:main.html");

?>