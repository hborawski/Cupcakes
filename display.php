 <?php

class tableBuilder{
	
	public function build($result){
		$numrows = mysql_num_rows($result);
		if($numrows == 0){
			echo "<h1 align='center'>Out of Stock</h1>";
		}
		echo "<div class='grid grid-pad'>";
		for($i = 0; $i<$numrows;$i++){
			$name = mysql_result($result,$i,"Name");
			$price = mysql_result($result,$i,"Price");
			$offers = mysql_result($result,$i,'SaleType');
			$num = mysql_result($result,$i,"Quantity");
			$tmpurl = mysql_result($result,$i,"URL");
			$tmp = mysql_result($result,$i,"Available");
			if($tmp =="on"){
				if($offers ==1){
					$offer = "Make an Offer";
					$avail = "For Sale or Best Offer";
				}else{
					$avail = "For Sale";
					$offer = "Buy This Item";
				}
				$button = "<tr><td><form action='offer.php' method='post'><input style='width:200px' type='submit' name='offer' value='$offer'><input type='hidden' name='name' value='$name'><input type='hidden' name='offer' value='$offers'><input type='hidden' name='price' value='$price'></form></td></tr>";
				$quant = "<br> Quantity In Stock: $num";
			}else{
				$avail = "Out of Stock";
				$button='';
			}
			$url = "images/" . $tmpurl;
    		echo "<div class='col-1-4'>";
			echo "<div class='module'>";
			echo "<table bordercolor='#000000' border='3px'><tr><td><div style='height:250px;overflow:hidden;vertical-align:middle;width:200px;position:relative;' ><img src=$url width='200px' style='position:absolute;top:0;bottom:0;margin:auto;'></div></td></tr><tr><td> $name <br> \$ $price <br> $avail $quant</td></tr>$button</table>";
			echo "</div>";
			echo "</div>";

		}
		echo "</div>";
			
	}
}



?>