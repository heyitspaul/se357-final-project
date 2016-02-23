<?php
	function menu($array, $name, $selected = ''){
		echo "<select class=\"form-control\" name=\"{$name}\">";
			foreach($array as $ar){
				echo "<option value=\"{$ar}\" ";
				if($ar == $selected){
					echo "selected=\"selected\"";
				}
				echo ">{$ar}</option>";
			}
		echo "</select>";
	}	
?>