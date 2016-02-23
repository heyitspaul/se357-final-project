<?php include("php/header.php"); ?>
<div class="container">
	<?php
		echo base64_encode(openssl_random_pseudo_bytes(32));
		//echo hash("sha256","memes");
	?>
</div>
<?php include("php/footer.php"); ?>