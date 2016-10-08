<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
$KEY = $_REQUEST['KEY'];
dbConnect();
$result=mysql_query("SELECT name FROM hotellist WHERE srno=$KEY") or die(mysql_error());
rrmdir("hoteldata/$KEY");
mysql_query("DELETE FROM imagelist WHERE hotelname = '$Name'") or die(mysql_error());
mysql_query("DELETE FROM hotellist WHERE srno = $KEY") or die(mysql_error());  	
mysql_query("DELETE FROM roomdetails WHERE hotelid = $KEY") or die(mysql_error());
mysql_free_result($result);
header("Location: hotel.php");
?>