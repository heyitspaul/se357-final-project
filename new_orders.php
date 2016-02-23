<?php include("php/header.php"); ?>
<div class="container">
	<div>
		<?php
			if(isVendor() == false){
				header("LOCATION: index.php");
			}
			else{
				global $user;
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if(isset($_POST['ShippedButton'])){
						$q = "UPDATE suborders SET fulfilled=1 WHERE suborder_id = {$_POST['suborder_id']}";
						$r = mysqli_query($dbc,$q);
					}
				}
			}
			global $user;
			$user_id = $user['user_id'];
			$q = "SELECT * FROM suborders INNER JOIN products ON suborders.product_id=products.product_id INNER JOIN orders ON orders.order_id=suborders.order_id INNER JOIN shopping_users ON shopping_users.user_id=orders.user_id WHERE products.vendor_id = '{$user_id}' AND fulfilled=0 ORDER BY orders.order_id ASC";
			$users = mysqli_query($dbc,$q);
			if(mysqli_num_rows($users) == 0){
				echo "<h3 style=\"text-align:center\">No new orders.</h3>";
			}
			while($p = mysqli_fetch_array($users)){
				$total = $p['unitprice'] * $p['quantity'];
				echo "<article class=\"product clearfix\">";
				echo "<div style=\"text-align:right\" class=\"pull-right\">";
				echo "<form action=\"\" method=\"POST\"><input type=\"text\" name=\"suborder_id\" value=\"{$p['suborder_id']}\" hidden><input type=\"submit\" name=\"ShippedButton\" value=\"Mark Shipped\" style=\"margin-right:10px;\" class=\"btn btn-success\" ></form>";
				echo "</div>";
				echo "<h1>{$p['product_name']}</h1>";
				echo "<p>Total cost: {$total}</p>";
				echo "<p>Quantity: {$p['quantity']}</p>";
				echo "<p>{$p['first_name']} {$p['last_name']}<br/>";
				echo "{$p['address']}<br/>";
				echo "{$p['city']}, {$p['state']} {$p['zipcode']}</p>";
				//echo "<h1>{$p['username']}</h1>";
				//echo "<p>{$p['first_name']} {$p['last_name']}</p>";
				//echo "<p>{$p['address']}</p>";
				//echo "<p>{$p['city']}, {$p['state']} {$p['zipcode']}</p>";
				echo "</article>";
			}	
		?>
	</div>
</div>
<?php include("php/footer.php"); ?>