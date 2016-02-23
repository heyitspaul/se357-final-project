<?php include("php/header.php"); ?>
<div class="container">
	<?php
		if($_COOKIE['cartjson'] != null){
			$cookiecart = json_decode($_COOKIE['cartjson'], true);
			$ids = "";
			for($i = 0; $i < count($cookiecart); $i++){
				if(count($cookiecart)-1 == $i){
					$ids = $ids . mysqli_real_escape_string($dbc,$cookiecart[$i]['product_id']);
				}
				else{
					$ids = $ids . mysqli_real_escape_string($dbc,$cookiecart[$i]['product_id']) . ",";
				}
			}
			echo "<table style=\"width:100%\">";
			echo "<th></th>";
			echo "<th style=\"text-align:center\">Price</th>";
			echo "<th style=\"text-align:center\">Quantity</th>";
			echo "<th></th>";
			$q = "SELECT * FROM products INNER JOIN shopping_users ON products.vendor_id=shopping_users.user_id WHERE product_id IN ({$ids})";
			$cart = mysqli_query($dbc,$q);
			while($p = mysqli_fetch_array($cart)){
				echo "<tr>";
					echo "<td>{$p['product_name']}";
					setlocale(LC_MONETARY,"en_US");
					$m = money_format("$%!i", $p['product_price']);
					echo "<td style=\"text-align:center\" class=\"product-price\">{$m}";
					$quantity = 1;
					for($i = 0; $i < count($cookiecart); $i++){
						if($cookiecart[$i]['product_id'] == $p['product_id']){
							$quantity = mysqli_real_escape_string($dbc,$cookiecart[$i]['quantity']);
						}
					}
					echo "<td style=\"text-align:center\"><input type=\"number\" style=\"width:50px; margin:0 auto;\"class=\"form-control \" onchange=\"updateQuantity({$p['product_id']},this.value)\" value=\"{$quantity}\"></td>";
					echo "<td style=\"text-align:center\"><button class=\"btn btn-danger btn-xs\" onclick=\"removeFromCartJson({$p['product_id']})\">Remove</button></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else{
			echo "<h3 style=\"text-align:center\">You don't have any items in your cart.";
		}
	if(isLoggedIn()){
	echo "<form action=\"checkout.php\" method=\"POST\">";
	echo "<input type=\"submit\" value=\"Checkout\" class=\"btn btn-primary\">";
	echo "</form>";
	}
	?>
</div>
<?php include("php/footer.php"); ?>