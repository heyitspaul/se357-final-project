<?php include("php/header.php"); ?>
<div class="container">
	<div>
		<?php
			include("php/menu.php");
			if(isLoggedIn() == false){
				header("LOCATION: index.php");
			}
			else{
				global $user;
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if(isset($_POST['UpdateButton'])){
						$user_id = $user['user_id'];
						$username = mysqli_real_escape_string($dbc,$_POST['username']);
						$email = mysqli_real_escape_string($dbc,$_POST['email']);
						$first_name = mysqli_real_escape_string($dbc,$_POST['first_name']);
						$last_name = mysqli_real_escape_string($dbc,$_POST['last_name']);
						$address = mysqli_real_escape_string($dbc,$_POST['address']);
						$city = mysqli_real_escape_string($dbc,$_POST['city']);
						$state = mysqli_real_escape_string($dbc,$_POST['state']);
						$zipcode = mysqli_real_escape_string($dbc,$_POST['zipcode']);
						$q = "UPDATE shopping_users SET username='{$username}', email='{$email}', first_name='{$first_name}', last_name='{$last_name}', address='{$address}', city='{$city}', state='{$state}', zipcode='{$zipcode}' WHERE user_id = {$user_id}";
						$r = mysqli_query($dbc,$q);
						$_SESSION['username'] = $username;
					}
					else if(isset($_POST['VendorButton'])){
						$user_id = $user['user_id'];
						$q = "UPDATE shopping_users SET vendor_applied=1 WHERE user_ID = {$user_id}";
						$r = mysqli_query($dbc,$q);
					}
					unset($user);
					getUser();
				}
			}
			global $user;
			echo "<article class=\"product clearfix\">";
			echo "<form action=\"\" method=\"POST\" class=\"form-horizontal\">";
				echo "<div class=\"form-group\">";
					echo "<label class=\"control-label col-sm-3\">Username</label>";
					echo "<div class=\"col-sm-9\">";
						echo "<input type=\"text\" class=\"form-control\" name=\"username\" value=\"{$user['username']}\">";
					echo "</div>";
				echo "</div>";
				echo "<div class=\"form-group\">";
					echo "<label class=\"control-label col-sm-3\">Email Address</label>";
					echo "<div class=\"col-sm-9\">";
						echo "<input type=\"text\" class=\"form-control\" name=\"email\" value=\"{$user['email']}\">";
					echo "</div>";
				echo "</div>";
				echo "<div class=\"form-group\">";
					echo "<label class=\"control-label col-sm-3\">First Name</label>";
					echo "<div class=\"col-sm-9\">";
						echo "<input type=\"text\" class=\"form-control\" name=\"first_name\" value=\"{$user['first_name']}\">";
					echo "</div>";
				echo "</div>";
				echo "<div class=\"form-group\">";
					echo "<label class=\"control-label col-sm-3\">Last Name</label>";
					echo "<div class=\"col-sm-9\">";
						echo "<input type=\"text\" class=\"form-control\" name=\"last_name\" value=\"{$user['last_name']}\">";
					echo "</div>";
				echo "</div>";
				echo "<div class=\"form-group\">";
					echo "<label class=\"control-label col-sm-3\">Address</label>";
					echo "<div class=\"col-sm-9\">";
						echo "<input type=\"text\" class=\"form-control\" name=\"address\" value=\"{$user['address']}\">";
					echo "</div>";
				echo "</div>";
				echo "<div class=\"form-group\">";
					echo "<label class=\"control-label col-sm-3\">City</label>";
					echo "<div class=\"col-sm-9\">";
						echo "<input type=\"text\" class=\"form-control\" name=\"city\" value=\"{$user['city']}\">";
					echo "</div>";
				echo "</div>";
				echo "<div class=\"form-group\">";
					echo "<label class=\"control-label col-sm-3\">State</label>";
					echo "<div class=\"col-sm-9\">";
						menu(states(), 'state', $user['state']);
					echo "</div>";
				echo "</div>";
				echo "<div class=\"form-group\">";
					echo "<label class=\"control-label col-sm-3\">Zip Code</label>";
					echo "<div class=\"col-sm-9\">";
						echo "<input type=\"text\" class=\"form-control\" name=\"zipcode\" value=\"{$user['zipcode']}\">";
					echo "</div>";
				echo "</div>";
				echo "<div class=\"form-group\">";
					echo "<label class=\"control-label col-sm-3\"></label>";
					echo "<div class=\"col-sm-9\">";
						echo "<input class=\"btn btn-primary\" type=\"submit\" name=\"UpdateButton\" value=\"Update Account\">";
					echo "</div>";
				echo "</div>";
			echo "</form>";
			if($user['vendor_applied'] != true){
				echo "<form action=\"\" method=\"POST\" class=\"form-horizontal\">";
					echo "<div class=\"form-group\">";
						echo "<label class=\"control-label col-sm-3\"></label>";
						echo "<div class=\"col-sm-9\">";
							echo "<input class=\"btn btn-success\" type=\"submit\" name=\"VendorButton\" value=\"Apply for Vendor\">";
						echo "</div>";
					echo "</div>";
				echo "</form>";
			}
			echo "</article>";	
		?>
	</div>
</div>
<?php include("php/footer.php"); ?>