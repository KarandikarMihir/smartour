<?php include 'functions.php'; ?>
<?php SecurityCheck();
$KEY = $_REQUEST['KEY'];
dbConnect();
mysql_query("DELETE FROM statelist WHERE srno = $KEY") or die(mysql_error());  	
//header("Location: location.php");
echo '<meta http-equiv="refresh" content="0; url=location.php">';
?>