<?php include("php/header.php"); ?>
<div class="container">
	<div>
		<?php
			if(isAdmin() == false){
				header("LOCATION: index.php");
			}
			else{
				global $user;
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if(isset($_POST['RejectButton'])){
						$qu = "UPDATE shopping_users SET vendor_applied=0 WHERE user_id = {$_POST['user_id']}";
						$re = mysqli_query($dbc,$qu);
					}
					else if(isset($_POST['ApproveButton'])){
						$qu = "UPDATE shopping_users SET vendor=1 WHERE user_id = {$_POST['user_id']}";
						$re = mysqli_query($dbc,$qu);
					}
				}
			}
			global $user;
			$q = "SELECT * FROM shopping_users WHERE vendor_applied=1 AND vendor=0";
			$users = mysqli_query($dbc,$q);
			if(mysqli_num_rows($users) == 0){
				echo "<h3 style=\"text-align:center\">No users awaiting approval.</h3>";
			}
			while($p = mysqli_fetch_array($users)){
				echo "<article class=\"product clearfix\">";
				echo "<div style=\"text-align:right\" class=\"pull-right\">";
					echo "<form action=\"\" method=\"POST\"><input type=\"text\" name=\"user_id\" value=\"{$p['user_id']}\" hidden><input type=\"submit\" name=\"ApproveButton\" value=\"Approve\" style=\"margin-right:10px;\" class=\"btn btn-success\" ><input type=\"submit\" name=\"RejectButton\" value=\"Reject\" class=\"btn btn-danger\"></form>";
				echo "</div>";
				echo "<h1>{$p['username']}</h1>";
				echo "<p>{$p['first_name']} {$p['last_name']}</p>";
				echo "<p>{$p['address']}</p>";
				echo "<p>{$p['city']}, {$p['state']} {$p['zipcode']}</p>";
				echo "</article>";
			}	
		?>
	</div>
</div>
<?php include("php/footer.php"); ?>