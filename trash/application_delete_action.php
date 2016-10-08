<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
$AppKey = base64_decode($_REQUEST['AppKey']);
$EnqKey = base64_decode($_REQUEST['EnqKey']);
dbConnect();
mysql_query("UPDATE enquiry set applock=0 WHERE srno=$EnqKey") or die(mysql_error());
echo $AppKey . ' ' . $EnqKey;
mysql_query("DELETE FROM receipt WHERE srno=$AppKey") or die(mysql_error());
mysql_query("DELETE FROM feedback WHERE appno=$AppKey") or die(mysql_error());
mysql_query("DELETE FROM application WHERE srno =$AppKey") or die(mysql_error());
$MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog");
$MaxSr = mysql_fetch_array($MaxID, MYSQL_BOTH);
$MaxSr = intval($MaxID[0]) + 1;
mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'Application No. $AppKey Deleted','" . date('D, d-M-Y H-i-s T') . "','" . decrypt($_COOKIE['SmarTourID'], $Salt) . "')") or die(mysql_error());
echo '<meta http-equiv="refresh" content="0; url=application.php">';
?>