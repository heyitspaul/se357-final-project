<?php include("php/header.php"); ?>
<div class="container">
	<div>
		<?php
			global $user;
			$user_id = $user['user_id'];
			$q = "SELECT * FROM orders INNER JOIN suborders ON suborders.order_id=orders.order_id INNER JOIN products ON suborders.product_id=products.product_id WHERE user_id = {$user_id}";
			$orders = mysqli_query($dbc,$q);
			if(mysqli_num_rows($orders) == 0){
				echo "<h3 style=\"text-align:center\">No orders yet.</h3>";
			}
			$currentorder = 0;
			$sum = 0.00;
			while($p = mysqli_fetch_array($orders)){
				if($currentorder == 0){
					echo "<article class=\"product clearfix\">";
					$currentorder = $p['order_id'];
					echo "<h3 style=\"margin-top:10px\">Order #{$currentorder}</h3>";
					echo "<table style=\"width:100%\">";
					echo "<th></th>";
					echo "<th style=\"text-align:center\">Shipping Status</th>";
					echo "<th style=\"text-align:center\">Price</th>";
					echo "<th style=\"text-align:center\">Quantity</th>";
					echo "<th style=\"text-align:center\">Total</th>";
					echo "<tr>";
						echo "<td>{$p['product_name']}</td>";
						if($p['fulfilled']){
							echo "<td style=\"text-align:center\" class=\"text-success\" >Shipped</td>";
						}
						else{
							echo "<td style=\"text-align:center\" class=\"text-danger\" >Not Shipped</td>";
						}
						setlocale(LC_MONETARY,"en_US");
						$m = money_format("$%!i", $p['unitprice']);
						echo "<td style=\"text-align:center\" class=\"product-price\">{$m}</td>";
						echo "<td style=\"text-align:center\" >{$p['quantity']}</td>";
						$total = $p['unitprice'] * $p['quantity'];
						$sum = $sum + $total;
						$mp = money_format("$%!i", $total);						
						echo "<td style=\"text-align:center\" class=\"product-price\">{$mp}</td>";					
					echo "</tr>";
				}
				else if($currentorder == $p['order_id']){
					echo "<tr>";
						echo "<td>{$p['product_name']}</td>";
						if($p['fulfilled']){
							echo "<td style=\"text-align:center\" class=\"text-success\" >Shipped</td>";
						}
						else{
							echo "<td style=\"text-align:center\" class=\"text-danger\" >Not Shipped</td>";
						}
						setlocale(LC_MONETARY,"en_US");
						$m = money_format("$%!i", $p['unitprice']);
						echo "<td style=\"text-align:center\" class=\"product-price\">{$m}</td>";
						echo "<td style=\"text-align:center\" >{$p['quantity']}</td>";
						$total = $p['unitprice'] * $p['quantity'];
						$sum = $sum + $total;
						$mp = money_format("$%!i", $total);						
						echo "<td style=\"text-align:center\" class=\"product-price\">{$mp}</td>";					
					echo "</tr>";
				}
				else{
					echo "<tr>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td style=\"text-align:center\"><b>Total</b></td>";
					setlocale(LC_MONETARY,"en_US");
					$ordertotal = money_format("$%!i", $sum);
					echo "<td style=\"text-align:center\" class=\"product-price\"><b>{$ordertotal}</b></td>";
					echo "</tr>";
					echo "</table>";
					echo "</article>";
					echo "<article class=\"product clearfix\">";
					$currentorder = $p['order_id'];
					$sum = 0.00;
					echo "<h3 style=\"margin-top:10px\">Order #{$currentorder}</h3>";
					echo "<table style=\"width:100%\">";
					echo "<th></th>";
					echo "<th style=\"text-align:center\">Shipping Status</th>";
					echo "<th style=\"text-align:center\">Price</th>";
					echo "<th style=\"text-align:center\">Quantity</th>";
					echo "<th style=\"text-align:center\">Total</th>";
					echo "<tr>";
						echo "<td>{$p['product_name']}</td>";
						if($p['fulfilled']){
							echo "<td style=\"text-align:center\" class=\"text-success\" >Shipped</td>";
						}
						else{
							echo "<td style=\"text-align:center\" class=\"text-danger\" >Not Shipped</td>";
						}
						$m = money_format("$%!i", $p['unitprice']);
						echo "<td style=\"text-align:center\" class=\"product-price\">{$m}</td>";
						echo "<td style=\"text-align:center\">{$p['quantity']}</td>";
						$total = $p['unitprice'] * $p['quantity'];
						$sum = $sum + $total;
						$mp = money_format("$%!i", $total);						
						echo "<td style=\"text-align:center\" class=\"product-price\">{$mp}</td>";					
					echo "</tr>";
				}
			}
			echo "<tr>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td style=\"text-align:center\"><b>Total</b></td>";
			setlocale(LC_MONETARY,"en_US");
			$ordertotal = money_format("$%!i", $sum);
			echo "<td style=\"text-align:center\" class=\"product-price\"><b>{$ordertotal}</b></td>";
			echo "</tr>";
			echo "</table>";
			echo "</article>";
		?>
	</div>
</div>