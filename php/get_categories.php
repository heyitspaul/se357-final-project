<?php
	function getCategories(){
		$q = "SELECT * FROM categories";
		$r = mysqli_query($GLOBALS['dbc'],$q);
		$categories = array();
		while($c = mysqli_fetch_array($r)){
			$categories[] = $c['category_name'];
		}
		return $categories;
	}
	
	function getCategoryID($categoryName){
		$q = "SELECT * FROM categories WHERE category_name = '{$categoryName}'";
		$r = mysqli_query($GLOBALS['dbc'],$q);
		$category = mysqli_fetch_array($r);
		return $category['category_id'];
	}
	
	function getCategoryName($categoryID){
		$q = "SELECT * FROM categories WHERE category_id = {$categoryID}";
		$r = mysqli_query($GLOBALS['dbc'],$q);
		$category = mysqli_fetch_array($r);
		return $category['category_name'];
	}
?>