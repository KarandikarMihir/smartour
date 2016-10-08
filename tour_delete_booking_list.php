<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
if(isset($_GET['RcptKey']) && isset($_GET['AppKey']) && is_whole($_GET['RcptKey']) && is_whole($_GET['AppKey'])){
        $KEY = $_GET['RcptKey'];
        $APP = $_GET['AppKey'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=receipt_delete.php">';
    die();
}
dbConnect();
$result = mysql_query("SELECT amount FROM receipt WHERE srno=$KEY AND aid=$APP") or die(mysql_errno());
$row = mysql_fetch_array($result);
$amount = $row['amount'];
mysql_query("DELETE FROM receipt WHERE srno=$KEY") or die(mysql_error());
mysql_query("UPDATE application_amount SET balance_amount=balance_amount+$amount WHERE aid=$APP") or die(mysql_error());
//header('Location: hotel_delete_photos.php?KEY=' . $HotelID);
echo '<meta http-equiv="refresh" content="0; url=receipt_delete_action.php">';
?>
