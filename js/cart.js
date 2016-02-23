var addToCartJson = function(product_id,quantity){
	var a = {
		product_id: product_id,
		quantity: quantity
	}
	var cart = Cookies.get('cartjson');
	if(cart != null){
		var cartarray = JSON.parse(cart);
		var exists = false;
		for(var i = 0; i < cartarray.length; i++){
			if(cartarray[i]['product_id'] == product_id){
				exists = true;
			}
		}
		if(!exists){
			cartarray.push(a);
			Cookies.set('cartjson', JSON.stringify(cartarray));
			$('#cart-size').text(cartarray.length);
		}
	}
	else{
		var array = [];
		array.push(a);
		Cookies.set('cartjson', JSON.stringify(array));
		$('#cart-size').text("1");
	}
}

var removeFromCartJson = function(product_id) {
	var cart = Cookies.get('cartjson');
	var cartarray = JSON.parse(cart);
	var newcart = [];
	for(var i = 0; i < cartarray.length; i++){
		if(cartarray[i]['product_id'] != product_id){
			newcart.push(cartarray[i]);
		}
	}
	if(newcart.length == 0){
		Cookies.remove('cartjson');
	}
	else{
		Cookies.set('cartjson', JSON.stringify(newcart));
	}
	location.reload();
}

var updateQuantity = function(product_id,quantity){
	var cart = Cookies.get('cartjson');
	var cartarray = JSON.parse(cart);
	for(var i = 0; i < cartarray.length; i++){
		if(cartarray[i]['product_id'] == product_id){
			cartarray[i]['quantity'] = quantity;
			console.log(cartarray[i]['quantity']);
		}
	}
	Cookies.set('cartjson', JSON.stringify(cartarray));
}