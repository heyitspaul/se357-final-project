<?php include("php/header.php"); ?>
<div class="container">
	<div>
		<?php
			include("php/get_categories.php");
			include("php/menu.php");
			global $user;
			$categories = getCategories();
			if(isVendor() == false){
				header("LOCATION: index.php");
			}
			else{
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$product_name = mysqli_real_escape_string($dbc,$_POST['product_name']);
					$product_description = mysqli_real_escape_string($dbc,$_POST['product_description']);
					$product_price = mysqli_real_escape_string($dbc,$_POST['product_price']);
					$product_stock = mysqli_real_escape_string($dbc,$_POST['product_stock']);
					$category_id = getCategoryID(mysqli_real_escape_string($dbc,$_POST['category_name']));
					$product_picture = mysqli_real_escape_string($dbc,$_POST['product_picture']);
					$vendor_id = $user['user_id'];
					
					$q = "INSERT INTO products (product_name, product_description, product_price, product_stock, vendor_id, category_id, product_picture, product_approved) 
										VALUES ('{$product_name}', '{$product_description}', {$product_price}, {$product_stock}, {$vendor_id}, {$category_id}, '{$product_picture}', 0)";
					$r = mysqli_query($dbc,$q);
					if($r){
						header("LOCATION: vendor_products.php");
					}
				}
			}
		?>
		<form action="" method="POST" class="form-horizontal">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Product Name" name="product_name">
			</div>
			<div class="form-group">
				<textarea style="max-width:100%" class="form-control" placeholder="Product Description" name="product_description"></textarea>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input type="text" class="form-control" placeholder="Product Price" name="product_price">
				</div>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Product Quantity" name="product_stock">
			</div>
			<div class="form-group">
				<?php menu($categories,"category_name") ?>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Product Picture URL" name="product_picture">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary pull-right" value="Add Product">
			</div>
		</form>
	</div>
</div>
<?php include("php/footer.php"); ?>