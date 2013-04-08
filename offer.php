<title>Contact</title>
<?php

$name=$_POST['name'];
$price=$_POST['price'];
$offer=$_POST['offer'];
if($offer ==1){
	$header = 'Offer on: ';
	$footer = '';
}else{
	$header = 'Purchase of: ';
	$footer = " for \$$price";
}
echo "<form action='send.php' method='post'>";
echo "Email: <input type='text' name='from'><br>";
$subject= "Subject: $header $name $footer";
echo $subject;
echo "<br>";
if($offer == 1){
	echo "Message: <br>";
	echo "<textarea name='message' rows='5' cols='40'></textarea>";
}else{
	$default = "I am interested in $name for the listed price of \$$price . I can be reached at the given email or at: ";
	echo "<textarea name='message' rows='5' cols='40'>$default</textarea>";
	
}
echo "<br>";
echo "<input type='hidden' name='subject' value='$subject'>";
echo "<input type='submit' value='Send'>";
echo "</form>";
echo "<form method='link' action='main.html'>";
echo "<input type='submit' value='Back'>";
echo "</form>";
?>