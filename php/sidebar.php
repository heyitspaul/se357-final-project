<div class="sidebar">
	<h3>Categories</h3>
	<ul>
	<?php
		$q = "SELECT * FROM categories ORDER BY category_name ASC";
		$categories = mysqli_query($dbc,$q);
		while($row = mysqli_fetch_array($categories)){
			echo "<li><a href=\"products.php?category={$row['category_id']}\">{$row['category_name']}</a></li>";
		}
	?>
	</ul>
</div>