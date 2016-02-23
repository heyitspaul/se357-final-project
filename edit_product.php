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
					$product_id = mysqli_real_escape_string($dbc,$_POST['product_id']);
					$product_name = mysqli_real_escape_string($dbc,$_POST['product_name']);
					$product_description = mysqli_real_escape_string($dbc,$_POST['product_description']);
					$product_price = mysqli_real_escape_string($dbc,$_POST['product_price']);
					$product_stock = mysqli_real_escape_string($dbc,$_POST['product_stock']);
					$category_id = getCategoryID($_POST['category_name']);
					$product_picture = mysqli_real_escape_string($dbc,$_POST['product_picture']);
					$vendor_id = $user['user_id'];
					$q = "UPDATE products SET product_name='{$product_name}', product_description='{$product_description}', product_price={$product_price}, product_stock={$product_stock}, category_id={$category_id}, product_picture='{$product_picture}' WHERE product_id={$product_id} AND vendor_id={$vendor_id}";
					$r = mysqli_query($dbc,$q);
					if($r){
						header("LOCATION: vendor_products.php");
					}
				}
				if($_GET['product'] != null){
					$req = mysqli_real_escape_string($dbc,$_GET['product']);
					$q = "SELECT * FROM products WHERE product_id = {$req}";
					$r = mysqli_query($dbc,$q);
					$product = mysqli_fetch_array($r);
					if($product['vendor_id'] != $user['user_id']){
						header("LOCATION: vendor_products.php");
					}
				}
				else{
					header("LOCATION: vendor_products.php");
				}
			}
		?>
		<form action="" method="POST" class="form-horizontal">
			<?php echo "<input type=\"hidden\" name=\"product_id\" value=\"{$product['product_id']}\">" ?>
			<div class="form-group">
				<input type="text" class="form-control" <?php echo "value=\"{$product['product_name']}\"" ?> placeholder="Product Name" name="product_name">
			</div>
			<div class="form-group">
				<textarea style="max-width:100%" class="form-control" placeholder="Product Description" name="product_description"><?php echo $product['product_description'] ?></textarea>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input type="text" class="form-control" <?php echo "value=\"{$product['product_price']}\"" ?> placeholder="Product Price" name="product_price">
				</div>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" <?php echo "value=\"{$product['product_stock']}\"" ?> placeholder="Product Quantity" name="product_stock">
			</div>
			<div class="form-group">
				<?php menu($categories,"category_name", getCategoryName($product['category_id'])) ?>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" <?php echo "value=\"{$product['product_picture']}\"" ?> placeholder="Product Picture URL" name="product_picture">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary pull-right" value="Update Product">
			</div>
		</form>
	</div>
</div>
<?php include("php/footer.php"); ?>