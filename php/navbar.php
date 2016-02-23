<?php include("php/database_connect.php") ?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
			<a class="navbar-brand" href="index.php">Store</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="cart.php">Cart (<span id="cart-size"><?php
					if($_COOKIE['cartjson'] != null){
						$cart = json_decode($_COOKIE['cartjson'], true);
						echo count($cart);
					}
					else{
						echo "0";
					}
				?></span>)</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php include("php/verify_login.php");
					if(isLoggedIn()){
						echo "<li class=\"dropdown\"><a class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\">{$_SESSION['username']} <span class=\"caret\"></span></a>";
							echo "<ul class=\"dropdown-menu\" role=\"menu\">";
								echo "<li><a href=\"account.php\">Account</a></li>";
								echo "<li><a href=\"orders.php\">Orders</a></li>";
								if(isVendor()){
									echo "<li class=\"divider\"></li>";
									echo "<li class=\"dropdown-header\">Vendor</li>";
									echo "<li><a href=\"vendor_products.php\">Products</a></li>";
									echo "<li><a href=\"new_orders.php\">New Orders</a></li>";
									echo "<li><a href=\"vendor_sales.php\">Sales</a></li>";
								}
								if(isAdmin()){
									echo "<li class=\"divider\"></li>";
									echo "<li class=\"dropdown-header\">Admin</li>";
									echo "<li><a href=\"categories.php\">Categories</a></li>";
									echo "<li><a href=\"admin_products.php\">Approve Products</a></li>";
									echo "<li><a href=\"admin_vendors.php\">Approve Vendors</a></li>";
									echo "<li><a href=\"all_products.php\">Products</a></li>";
									echo "<li><a href=\"vendors.php\">Vendors</a></li>";
									echo "<li><a href=\"customers.php\">Customers</a></li>";
								}
								echo "<li class=\"divider\"></li>";
								echo "<li><a href=\"logout.php\">Log out</a></li>";
							echo "</ul>";
						echo "</li>";
					}
					else{
						echo "<li><a href=\"login.php\">Log in</a></li>";
						echo "<li><a href=\"register.php\">Register</a></li>";
					}
				?>
			</ul>
			<form method="GET" action="search.php" class="navbar-form navbar-right"><input type="text" name="q" class="form-control" placeholder="Search..."></form>
		</div>
	</div>
</nav>