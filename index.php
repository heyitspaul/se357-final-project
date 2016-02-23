<?php include("php/header.php"); ?>
<div class="container">
	<?php include("php/sidebar.php"); ?>
	<div class="main-content">
		<?php
			$q = "SELECT * FROM products INNER JOIN shopping_users ON products.vendor_id=shopping_users.user_id WHERE product_stock > 0 AND product_approved = 1 ORDER BY RAND() LIMIT 5";
			$products = mysqli_query($dbc,$q);
			while($p = mysqli_fetch_array($products)){
				echo "<article class=\"product clearfix\">";
				setlocale(LC_MONETARY,"en_US");
				$m = money_format("$%!i", $p['product_price']);
				echo "<div style=\"text-align:right\" class=\"pull-right\">";
					echo "<h1 class=\"product-price\">{$m}</h1>";
					echo "<button class=\"btn btn-primary\" onclick=\"addToCartJson({$p['product_id']},1)\">Add to Cart</button>";
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
				echo "</article>";
			}	
		?>
	</div>
</div>
<?php include("php/footer.php"); ?>