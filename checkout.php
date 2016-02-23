<?php include("php/header.php"); ?>
<div class="container">
	<?php
		global $user;
		if($_COOKIE['cartjson'] != null){
			$cookiecart = json_decode($_COOKIE['cartjson'], true);
			$ids = "";
			for($i = 0; $i < count($cookiecart); $i++){
				if(count($cookiecart)-1 == $i){
					$ids = $ids . $cookiecart[$i]['product_id'];
				}
				else{
					$ids = $ids . $cookiecart[$i]['product_id'] . ",";
				}
			}
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$user_id = $user['user_id'];
				$q = "INSERT INTO orders (user_id, date) VALUES ({$user_id},'2015-05-04')";
				$r = mysqli_query($dbc,$q);
				$order_id = mysqli_insert_id($dbc);
				echo $order_id;
				for($i = 0; $i < count($cookiecart); $i++){
					$product_id = $cookiecart[$i]['product_id'];
					$quantity = $cookiecart[$i]['quantity'];
					$qu = "SELECT * FROM products WHERE product_id={$product_id}";
					$re = mysqli_query($dbc,$qu);
					$p = mysqli_fetch_array($re);
					if($p['product_stock'] >= $cookiecart[$i]['quantity']){
						$que = "INSERT INTO suborders (order_id, product_id, quantity, unitprice, fulfilled) VALUES ({$order_id}, {$p['product_id']}, {$quantity}, {$p['product_price']}, 0)";
						$res = mysqli_query($dbc,$que);
						$quer = "UPDATE products SET product_stock = (product_stock - {$quantity}) WHERE product_id = {$product_id}";
						$resp = mysqli_query($dbc,$quer);
					}
				}
				setcookie('cartjson', "", 1);
				header("LOCATION: orders.php");
				//$q = "SELECT * FROM products INNER JOIN shopping_users ON products.vendor_id=shopping_users.user_id WHERE product_id IN ({$ids})";
				//$r = mysqli_query($dbc,$q);
			}
		}
		else{
			header("LOCATION: cart.php");
		}
	?>
</div>
<?php include("php/footer.php"); ?>