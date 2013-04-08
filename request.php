<title>Request an Item</title>
<?php

echo "<form action='send.php' method='post'>";
echo "Email: <input type='text' name='from'><br>";
$subject= "Subject: Item Request";
echo $subject;
echo "<br>";
echo "Give us information on what you need, we'll see what we can do. <br>";
echo "Message: <br>";
echo "<textarea name='message' rows='5' cols='40'></textarea>";
echo "<br>";
echo "<input type='hidden' name='subject' value='$subject'>";
echo "<input type='submit' value='Send'>";
echo "</form>";
echo "<form method='link' action='main.html'>";
echo "<input type='submit' value='Back'>";
echo "</form>";
?>