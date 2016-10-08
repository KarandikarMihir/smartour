<?php include 'functions.php'; ?>
<?php SecurityCheck();
$RcptKey = $_REQUEST['RcptKey'];
$AppKey = $_REQUEST['AppKey'];
dbConnect();
$result=mysql_query("SELECT amount from receipt WHERE srno=$RcptKey") or die(mysql_error());
$row = mysql_fetch_array($result);
$Amount = $row['amount'];
mysql_query("UPDATE application set balance=balance+$Amount WHERE srno=$AppKey") or die(mysql_error());
mysql_query("DELETE FROM receipt WHERE srno =$RcptKey") or die(mysql_error());	

$MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog") or die(mysql_error());
$MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
$MaxSr = intval($MaxSr[0]) + 1;
mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'Receipt No. $RcptKey deleted','" . date('D, d-M-Y H-i-s T') . "','" . decrypt($_COOKIE['SmarTourID'], $Salt) . "')") or die(mysql_error());
//header("Location: receipt.php");
echo '<meta http-equiv="refresh" content="0; url=receipt.php">';
?>
