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
					$offer = "Offer";
					$avail = "For Sale or Best Offer";
				}else{
					$avail = "For Sale";
					$offer = "Buy";
				}
				$button = "<tr><td><form action='offer.php' method='post'><input style='width:200px' type='submit' name='offer' value='$offer'><input type='hidden' name='name' value='$name'><input type='hidden' name='offer' value='$offers'><input type='hidden' name='price' value='$price'></form></td></tr>";
				$quant = "<br> Quantity In Stock: $num";
			}else{
				$avail = "Out of Stock";
				$button='';
			}
			$url = "images/" . $tmpurl;
			echo "<li class=\"span3\">
				<div class=\"thumbnail\">
					<img src=\"$tmpurl\" alt="">
					<h3 class=\"text-center\">$name</h3>
					<p class=\"span2\">
						\$ $price
						<br>
						$avail
						<br>
						Quantity In Stock: $num
					</p>
					<div class=\"row-fluid\">
						<div class=\"span6\">
							<button class=\"btn btn-primary btn-block\">
								$offer
							</button>
						</div>
						<div class=\"span6\">
							<button class=\"btn btn-info btn-block\">
								More Info
							</button>
						</div>
					</div>
				</div>
			</li>";
		}
		echo "</div>";
			
	}
}



?>