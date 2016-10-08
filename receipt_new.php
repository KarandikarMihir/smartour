<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=receipt.php">';
    die();
}

if ($_POST)
{
    dbConnect(); 
    $Name = SafeString($_POST['name']);
    $HotelName = SafeString($_POST['hotelname']);
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
    mysql_query("INSERT INTO receipt(amount,paymode,chqbank,chqdate,chqnum,cardtype,aid) VALUES($Amount, '$PayMode', '$ChqBank', '$ChqDate', '$ChqNum', '$CardType', $KEY)") or die(mysql_error());
    mysql_query("UPDATE application_amount set balance_amount=balance_amount - $Amount WHERE aid=$KEY") or die(mysql_error());
    
    //header('location: receipt.php');
    echo '<meta http-equiv="refresh" content="0; url=receipt.php">';
}
else
{
    dbConnect();
    $result = mysql_query("SELECT application.srno, customer.name, hotellist.name as hotelname, application_amount.balance_amount FROM application, enquiry, customer, application_amount, hotellist WHERE application.eid = enquiry.srno AND enquiry.cid = customer.srno AND application.hid = hotellist.srno and application_amount.aid=application.srno and application.srno = " . $KEY) or die(mysql_error());
    if(!mysql_num_rows($result)){
        echo '<meta http-equiv="refresh" content="0; url=receipt.php">';
        die();
    }

    while($row = mysql_fetch_array($result))
    {
        $AppNo = $row['srno'];
        $Name = $row['name'];
        $HotelName = $row['hotelname'];
        $Balance = $row['balance_amount'];
    }
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">New Receipt</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="receipt_new.php?KEY=<?php echo $KEY;?>" novalidate="novalidate">
    <div style="float:left;width:250px">
        <p>Name</p>
        <div class="input-control text"><input type="text" name="name" class="validate-name" value="<?php echo $Name; ?>" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>Hotel Name</p>
        <div class="input-control text"><input type="text" name="hotelname" class="validate-name" value="<?php echo $HotelName; ?>" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
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
                    <option>Cash</option>
                    <option>Cheque</option>
                    <option>Credit/Debit Card</option>
                    <option>Wire Transfer</option>
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
                    <option>Master</option>
                    <option>Visa</option>
                    <option>Other</option>
                </select>
            </div>
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" name="submit" value="Submit"></p>
        </div>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>
