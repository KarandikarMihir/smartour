<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=cancellation.php">';
    die();
}

if ($_POST)
{
    dbConnect();
    $RefundAmt = SafeString($_POST['refund']);
    $CancelCharge = SafeString($_POST['ccharges']);
    mysql_query("UPDATE application set balance=0, refundamt=$RefundAmt, cancelcharge=$CancelCharge, cancelflag=1 WHERE srno=$KEY") or die(mysql_error());
    
    $MaxSr = mysql_query("SELECT MAX(SrNo) FROM activitylog") or die(mysql_error());
    $MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
    $MaxSr = intval($MaxSr[0]) + 1;
    mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'Application No. $KEY Cancelled','" . date('D, d-M-Y H-i-s T') . "','" . decrypt($_COOKIE['SmarTourID'], $Salt) . "')") or die(mysql_error());

    //header('location: cancellation.php');
    echo '<meta http-equiv="refresh" content="0; url=cancellation.php">';
}
else
{
    dbConnect();
    $result = mysql_query("SELECT * FROM application WHERE srno = " . $KEY) or die(mysql_error());
    if(!mysql_num_rows($result) || mysql_error()){
        echo '<meta http-equiv="refresh" content="0; url=cancellation.php">';
        die();
    }

    while($row = mysql_fetch_array($result))
    {
        $AppNo = $row['srno'];
        $Name = $row['name'];
        $HotelName = $row['hotelname'];
        $TotalAmt = $row['totalamt'];
        $SCharge = $row['scharge'];
        $Balance = $row['balance'];
    }
    mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Cancellation</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="cancellation_new.php?KEY=<?php echo $KEY;?>" novalidate="novalidate">
        <div style="float:left;width:250px">
            <p>Name</p>
            <div class="input-control text"><input type="text" name="name" class="validate-name" value="<?php echo $Name; ?>"  readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Hotel Name</p>
            <div class="input-control text"><input type="text" name="hotelname" class="validate-name" value="<?php echo $HotelName; ?>" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Total Amount</p>
            <div class="input-control text"><input type="text" name="totalamt" id="totalamt" class="amt" value="<?php echo $TotalAmt; ?>" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Service Charge</p>
            <div class="input-control text"><input type="text" name="scharge" id="scharge" class="amt" value="<?php echo $SCharge; ?>" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        </div>
        <div id="separator" style="float:left;width:40px">&nbsp;</div>
        <div style="float:left;width:260px">
            <p>Balance Amount</p>
            <div class="input-control text"><input type="text" name="balance" id="balance" style="width:250px;" value="<?php echo $Balance; ?>" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Cancellation Charges</p>
            <div class="input-control text"><input type="text" name="ccharges" id="ccharge" class="amt" value="0" style="width:250px;" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Refundable Amount</p>
            <div class="input-control text"><input type="text" name="refund" id="refund" class="amt" style="width:250px;" value="0" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>&nbsp;</p>
            <p style="text-align:right;"><a href="javascript:;" onclick="alert('Negative Refund Amount should be considered as a due payment from the customer.')">[?]</a> <input type="submit" name="submit" value="Cancel Booking"></p>
        </div>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>
