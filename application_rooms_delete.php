<?php include 'functions.php'; ?>
<?php SecurityCheck();
$srno = $_REQUEST['KEY'];
$KEY = $_REQUEST['AppID'];
dbConnect();
mysql_query("DELETE FROM application_rooms WHERE srno = $srno") or die(mysql_error());  	
//header("Location: location.php");
echo '<meta http-equiv="refresh" content="0; url=application_rooms.php?KEY=' . $KEY . '">';
?>
