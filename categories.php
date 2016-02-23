<?php include("php/header.php"); ?>
<div class="container">
	<div>
		<div class="clearfix" style="margin-bottom:10px">
			<form class="form-inline" action="" method="POST">
				<input class="form-control" type="text" name="category_name" placeholder="Category Name">
				<input class="btn btn-success" type="submit" name="AddButton" value="Add Category">
			</form>
		</div>
		<?php
			if(isAdmin() == false){
				header("LOCATION: index.php");
			}
			else{
				global $user;
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if(isset($_POST['DeleteButton'])){
						$q = "DELETE FROM categories WHERE category_id = {$_POST['category_id']}";
						$r = mysqli_query($dbc,$q);
					}
					else if(isset($_POST['AddButton'])){
						$category_name = mysqli_real_escape_string($dbc,$_POST['category_name']);
						$q = "INSERT INTO categories (category_name) VALUES ('{$category_name}')";
						$r = mysqli_query($dbc,$q);
					}
				}
				
				$q = "SELECT * FROM categories ORDER BY category_name ASC";
				$r = mysqli_query($dbc,$q);
				while($category = mysqli_fetch_array($r)){
					echo "<div class=\"clearfix\" style=\"margin-bottom:10px;\">";
					echo "<form class=\"pull-left\" action=\"\" method=\"POST\"><input type=\"text\" name=\"category_id\" value=\"{$category['category_id']}\" hidden><input type=\"submit\" name=\"DeleteButton\" value=\"Delete\" class=\"btn btn-danger btn-xs\"></form>";
					echo "<span style=\"margin-left:5px\">{$category['category_name']}</span>";
					echo "</div>";
				}
				
			}	
		?>
	</div>
</div>
<?php include("php/footer.php"); ?>