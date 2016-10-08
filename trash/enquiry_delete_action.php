<?php include 'functions.php'; ?>
<?php SecurityCheck();
$KEY = $_REQUEST['KEY'];
dbConnect();
mysql_query("DELETE FROM enquiry WHERE srno = '$KEY'") or die(mysql_error());  	

$MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog") or die(mysql_error());
$MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
$MaxSr = intval($MaxSr[0]) + 1;
mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'Enquiry No. $KEY Deleted','" . date('D, d-M-Y H-i-s T') . "','" . decrypt($_COOKIE['SmarTourID'], $Salt) . "')") or die(mysql_error());
//header("Location: enquiry.php");
echo '<meta http-equiv="refresh" content="0; url=enquiry.php">';
?>