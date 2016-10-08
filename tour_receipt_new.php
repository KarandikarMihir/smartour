<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=tour_booking_receipt.php">';
    die();
}

if ($_POST)
{
    dbConnect();
    $Amount = SafeString($_POST['amount']);
    $PayMode = SafeString($_POST['paymode']);
    if(isset($_POST['chqbank']))
        $ChqBank = SafeString($_POST['chqbank']);
    else
        $ChqBank = NULL;
    if(isset($_POST['chqdate']))
        $ChqDate = SafeString($_POST['chqdate']);
    else
        $ChqDate = NULL;
    if(isset($_POST['chqnum']))
        $ChqNum = SafeString($_POST['chqnum']);
    else
        $ChqNum = NULL;
    if(isset($_POST['cardtype']))
        $CardType = SafeString($_POST['cardtype']);
    else
        $CardType = NULL;
    $username = decrypt($_COOKIE['SmarTourID'], $Salt);
    $uid = namei($username);    
    mysql_query("INSERT INTO tour_receipt(amount,paymode,chqbank,chqnum,chqdate,cardtype,aid, uid) VALUES($Amount, '$PayMode', '$ChqBank', '$ChqNum', '$ChqDate', '$CardType', $KEY, $uid)") or die(mysql_error());
    
    //header('location: receipt.php');
    echo '<meta http-equiv="refresh" content="0; url=tour_booking_receipt.php">';
    die();
}
else
{
    dbConnect();
    $result = mysql_query("SELECT application_tour.srno, application_tour.seats, customer.name as cname, tour.name as tname, tour.price, tour.stax FROM application_tour, customer, tour WHERE application_tour.srno = $KEY AND application_tour.cid = customer.srno AND application_tour.tid = tour.srno") or die(mysql_error());
    if(!mysql_num_rows($result)){
        echo '<meta http-equiv="refresh" content="0; url=tour_booking_receipt.php">';
        die();
    }
    $row = mysql_fetch_array($result);
    
    $result_=mysql_query("SELECT SUM(amount) as amt FROM tour_receipt WHERE aid=$KEY AND cancelflag=0") or die(mysql_error());
    $row_=  mysql_fetch_array($result_);
    $Amt = $row_['amt'];
        
    $AppNo = $row['srno'];
    $Seats = $row['seats'];
    $Name = $row['cname'];
    $TourName = $row['tname'];
    $Price = $row['price'];
    $STax = $row['stax'];
    
    $Balance = (($Price*$Seats)+($STax*$Seats))-$Amt;
    if($Balance==0){
        echo '<meta http-equiv="refresh" content="0; url=tour_booking_receipt.php">';
        die();        
    }
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">New Receipt</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="tour_receipt_new.php?KEY=<?php echo $KEY;?>" novalidate="novalidate">
    <div style="float:left;width:250px">
        <p>Name</p>
        <div class="input-control text"><input type="text" name="name" value="<?php echo $Name; ?>" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>Tour Name</p>
        <div class="input-control text"><input type="text" name="hotelname" value="<?php echo $TourName; ?>" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>Balance</p>
        <div class="input-control text"><input type="text" name="balance" class="amt" value="<?php echo $Balance; ?>" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>Amount</p>
        <div class="input-control text"><input type="text" name="amount" class="amt" value="<?php echo $Balance; ?>" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
    </div>
        <div id="separator" style="float:left;width:40px">&nbsp;</div>
        <div style="float:left;width:260px">
            <p>Payment Mode</p>
            <div class="input-control select">
                <select name="paymode" onchange="enableOptions(this.value);">
                    <option value="1">Cash</option>
                    <option value="2">Cheque</option>
                    <option value="3">Credit/Debit Card</option>
                    <option value="4">Wire Transfer</option>
                </select>
            </div>
            <p>Bank and Branch Name</p>
            <div class="input-control text"><input type="text" name="chqbank" disabled="disabled" placeholder="ICICI Bank, Shivajinagar Branch" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Cheque Number</p>
            <div class="input-control text"><input type="text" name="chqnum" disabled="disabled" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Cheque Date</p>
            <div class="input-control text"><input type="date" name="chqdate" disabled="disabled" placeholder="yyyy-mm-dd" min="<?php echo date("Y-m-d");?>" style="width:100%;height:32px;" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        </div>
        <div id="separator" style="float:left;width:40px">&nbsp;</div>
        <div style="float:left;width:260px">
            <p>Card Type</p>
            <div class="input-control select">
                <select name="cardtype" disabled="disabled">
                    <option></option>
                    <option value="1">Master</option>
                    <option value="2">Visa</option>
                    <option value="3">Other</option>
                </select>
            </div>
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" name="submit" value="Submit"></p>
        </div>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>
