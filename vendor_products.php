<?php include("php/header.php"); ?>
<div class="container">
	<div>
		<div class="clearfix" style="margin-bottom:10px">
			<a href="add_product.php" class="btn btn-success pull-right">Add Product</a>
		</div>
		<?php
			if(isVendor() == false){
				header("LOCATION: index.php");
			}
			else{
				global $user;
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if(isset($_POST['DeleteButton'])){
						$q = "SELECT * FROM products WHERE product_id = {$_POST['product_id']}";
						$r = mysqli_query($dbc,$q);
						$product = mysqli_fetch_array($r);
						if($user['user_id'] == $product['vendor_id']){
							$qu = "DELETE FROM products WHERE product_id = {$_POST['product_id']}";
							$re = mysqli_query($dbc,$qu);
						}
					}
				}
			}
			global $user;
			$q = "SELECT * FROM products INNER JOIN shopping_users ON products.vendor_id=shopping_users.user_id WHERE vendor_id = {$user['user_id']} ORDER BY product_id DESC";
			$products = mysqli_query($dbc,$q);
			if(mysqli_num_rows($products) == 0){
				echo "<h3 style=\"text-align:center\">No products found.</h3>";
			}
			while($p = mysqli_fetch_array($products)){
				echo "<article class=\"product clearfix\">";
				setlocale(LC_MONETARY,"en_US");
				$m = money_format("$%!i", $p['product_price']);
				echo "<div style=\"text-align:right\" class=\"pull-right\">";
					echo "<h1 class=\"product-price\">{$m}</h1>";
					echo "<form action=\"\" method=\"POST\"><a style=\"margin-right:10px;\" href=\"edit_product.php?product={$p['product_id']}\" class=\"btn btn-primary\">Edit</a>";
					if(!$p['product_approved']){
						echo "<input type=\"text\" name=\"product_id\" value=\"{$p['product_id']}\" hidden><input type=\"submit\" name=\"DeleteButton\" value=\"Delete\" class=\"btn btn-danger\">";
					}
					echo "</form>";
				echo "</div>";
				echo "<h1><a href=\"products.php?product={$p['product_id']}\">{$p['product_name']}</a></h1>";
				echo "<h4>Sold by {$p['username']}</h4>";
				$state = getState($p['state']);
				echo "<h5>Ships from {$state}</h5>";
				if($p['product_picture'] != null){
					echo "<img style=\"height:100px; width:auto; margin-right:5px;\" class=\"pull-left\" src=\"{$p['product_picture']}\" />";
				}
				echo "<p>{$p['product_description']}</p>";
				if($p['product_stock'] < 10){
					echo "<p class=\"text-danger\">Only {$p['product_stock']} left in stock!</p>";
				}
				if(!$p['product_approved']){
					echo "<p class=\"text-danger\">Product has not yet been approved.</p>";
				}
				echo "<p>Total stock: {$p['product_stock']}";
				echo "</article>";
			}	
		?>
	</div>
</div>
<?php include("php/footer.php"); ?>