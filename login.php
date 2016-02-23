<?php include("php/header.php"); ?>
<div class="container">
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$username = mysqli_real_escape_string($dbc,$_POST['username']);
			$password = mysqli_real_escape_string($dbc,$_POST['password']);
			$q = "SELECT * FROM shopping_users WHERE username = '{$username}'";
			echo $q;
			$r = mysqli_query($dbc, $q);
			$user = mysqli_fetch_array($r);
			if(hash("sha256", "{$user['salt']}{$password}") == $user['password']){
				$_SESSION['username'] = $username;
				header("LOCATION: index.php");
			}
		}
	?>
	<div class="login">
		<h1>Sign in</h1>
		<div class="login">
			<form action="" method="POST" class="form-horizontal">
				<div class="form-group">
					<input class="form-control" type="text" placeholder="Username" name="username" />
				</div>
				<div class="form-group">
					<input class="form-control" type="password" placeholder="Password" name="password" />
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right" name="Submit" value="Log in" />
				</div>
			</form>
		</div>
	</div>
</div>
<?php include("php/footer.php"); ?>