<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=receipt.php">';
    die();
}

dbConnect();
$result = mysql_query("SELECT receipt.srno as rno,receipt.amount,receipt.paymode,receipt.chqbank,"
        . "receipt.chqdate,receipt.chqnum,receipt.cardtype,application.srno as ano,application.chkin,"
        . "application.chkout,(sum(application_amount.basic_amount)+sum(application_amount.scharge)+"
        . "sum(application_amount.stax)+sum(application_amount.ltax)) as gtotal,customer.name,hotellist.name as hotelname"
        . " FROM receipt,application,enquiry,customer,application_amount,hotellist"
        . " WHERE receipt.aid = application.srno and application.eid = enquiry.srno and "
        . "enquiry.cid = customer.srno and application.hid = hotellist.srno and application_amount.aid = application.srno and receipt.srno = $KEY") or die(mysql_error());
if(!mysql_num_rows($result)){
    echo '<meta http-equiv="refresh" content="0; url=receipt.php">';
    die();
}

while($row = mysql_fetch_array($result))
{
    $RcptSrno = $row['rno'];
    $Amount = $row['amount'];
    $PayMode = $row['paymode'];
    $ChqBank = $row['chqbank'];
    $ChqDate = $row['chqdate'];
    $ChqNum = $row['chqnum'];
    $CardType = $row['cardtype'];
    $AppNo = $row['ano'];
    $ChkIn = $row['chkin'];
    $ChkOut = $row['chkout'];
    $Name = $row['name'];
    $HotelName = $row['hotelname'];
    $TotalAmt = $row['gtotal'];
}
$result = mysql_query("SELECT * FROM params");
while($row = mysql_fetch_array($result))
{
    $TCNumber = $row['tcno']; 
    $CName = $row['cname'];
    $CAddress = $row['address'];
    $CContact = $row['contact'];
    $CMobile = $row['mobile'];
    $CEmail = $row['email'];
    $CWebsite = $row['website'];
    $FBURL = $row['fburl'];
    $Logo = $row['logo'];
}	
?>
<!DOCTYPE html>
<html style="background-color: #ccc">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="images/favicon_main.ico" type="image/x-icon">
        <title>Receipt</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body class="metrouicss" style="height: 11.69in;width: 8.27in;margin: auto;padding: 20px;background-color: #fff;box-shadow: 0 0 15px #999;-webkit-box-shadow: 0 0 15px #999;-moz-box-shadow: 0 0 15px #999;">
        <p style="text-align: right;padding: 5px;background: #eee;"><strong>Customer's Copy</strong></p>
        <div style="width: 25%;overflow: auto;float: left;text-align: center;">
            <img src="<?php echo $Logo; ?>" style="width: 90%;" />
<!--            <p>Agency Slogan</p>-->
        </div>
        <div style="width: 75%;padding-left: 15px;overflow: auto;float: left;border-left: 1px solid #ddd;">
            <h2 style="margin: 0 0 7px 0;"><strong><?php echo $CName; ?></strong></h2><p><?php echo $CAddress; ?></p><p><strong>Contact:</strong> <?php echo $CContact; ?> <strong>Mobile:</strong> <?php echo $CMobile; ?></p><p><strong>Email:</strong> <?php echo $CEmail; ?> <strong>Website:</strong> <?php echo $CWebsite; ?></p>
        </div>
        <div style="width: 100%;float: left;padding: 5px;background: #0070b1;">
            <p class="fg-color-white" style="margin: 0;"><span style="width: 24%;float: left;"><strong>Receipt No. <?php echo $RcptSrno; ?></strong></span>|<span style="padding-left: 12px;"><strong><?php echo $HotelName;?></strong></span></p>
        </div>
        <div style="width: 100%;float: left;text-align: justify;padding: 10px;border-bottom: 1px solid #ddd;">
            <p>Received with thanks from Mr./Mrs./Ms. <strong><?php echo $Name; ?></strong>, Rupees <strong><?php echo numtoword(round($Amount)); ?></strong> Only</p>
            <p>For the hotel booking at <strong><?php echo $HotelName; ?></strong> From <strong><?php echo $ChkIn; ?></strong> To <strong><?php echo $ChkOut; ?></strong> (Booking Amount: <strong>₹<?php echo $TotalAmt; ?></strong>)</p>
        </div>
        <div style="width: 100%;float: left;padding: 10px;">
            <p><strong>Receipt Details</strong></p>
            <table style="margin: 0;">
                <tr>
                    <td>Payment Mode</td>
                    <td>
                        <?php
                        switch($PayMode)
                        {
                            case 0: echo 'Cash';
                                    break;
                            case 1: echo 'Cheque';
                                    break;
                            case 2: echo 'Credit/Debit Card';
                                    break;
                            case 3: echo 'Wire Transfer';
                                    break;
                        }
                        ?>
                    </td>
                </tr>
                <tr><td>Bank Details</td><td><?php if($PayMode==2){echo $ChqBank;} else echo 'NA'; ?></td></tr>
                <tr><td>Cheque Date</td><td><?php if($PayMode==2){echo $ChqDate;} else echo 'NA'; ?></td></tr>
                <tr><td>Cheque Number</td><td><?php if($PayMode==2){echo $ChqNum;} else echo 'NA'; ?></td></tr>
                <tr><td>Card Type</td><td><?php if($PayMode==3){echo $CardType;} else echo 'NA'; ?></td></tr>
                <tr><td><strong>Receipt Amount</strong></td><td><strong><span style="font-family: DejaVu Sans;">&#x20b9;</span><?php echo number_format($Amount, 2, '.', '');?></strong></td></tr>
                <tr><td colspan="2">In words: Rupees <?php echo numtoword(round($Amount)); ?> only (rounded-off)</td></tr>
                <tr><td colspan="2">Note: Cheque subject to realization. We reserve the right to cancel the booking for non-receipt of full payment and refund will be paid after deducting cancellation and service charges.</td></tr>
            </table>
        </div>
        <div style="width: 100%;height: 100px;padding: 10px;text-align: right;float: left;border-bottom: 1px solid #ddd;">
            <p><strong>For <?php echo $CName; ?></strong></p><br>
            <p><strong>Authorized Signatory</strong></p>
        </div>
        <hr style="margin: 0;border: 1px dashed #000;">
        <p style="text-align: right;padding: 5px;background: #eee;margin: 0;"><strong>Accounts Copy</strong></p>
        <div style="width: 100%;float: left;padding: 10px;border-bottom: 1px solid #ddd;">
            <p><strong>Receipt No. <?php echo $SrNo; ?></strong></p>
            <p>Name: Mr./Mrs./Ms. <strong><?php echo $Name; ?></strong> Amount: <strong>Rs. <?php echo round($Amount); ?></strong></p>
            <p>For the hotel booking at <strong><?php echo $HotelName; ?></strong> From <strong><?php echo $ChkIn; ?></strong> To <strong><?php echo $ChkOut; ?></strong></p>
        </div>
        <div style="width: 100%;float: left;padding: 10px;">
            <p><strong>Receipt Details</strong></p>
            <table style="margin: 0;">
                <tr>
                    <td>Payment Mode</td>
                    <td>
                        <?php
                        switch($PayMode)
                        {
                            case 0: echo 'Cash';
                                    break;
                            case 1: echo 'Cheque';
                                    break;
                            case 2: echo 'Credit/Debit Card';
                                    break;
                            case 3: echo 'Wire Transfer';
                                    break;
                        }
                        ?>
                    </td>
                </tr>
                <tr><td>Bank Details</td><td><?php if($PayMode==2){echo $ChqBank;} else echo 'NA'; ?></td></tr>
                <tr><td>Cheque Date</td><td><?php if($PayMode==2){echo $ChqDate;} else echo 'NA'; ?></td></tr>
                <tr><td>Cheque Number</td><td><?php if($PayMode==2){echo $ChqNum;} else echo 'NA'; ?></td></tr>
                <tr><td>Card Type</td><td><?php if($PayMode==3){echo $CardType;} else echo 'NA'; ?></td></tr>
                <tr><td><strong>Receipt Amount</strong></td><td><strong><span style="font-family: DejaVu Sans;">&#x20b9;</span><?php echo number_format($Amount, 2, '.', '');?></strong></td></tr>
                <tr><td colspan="2">In words: Rupees <?php echo numtoword(round($Amount)); ?> only (rounded-off)</td></tr>
            </table>
        </div>
    </body>
</html>
