<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=invoice_search.php">';
    die();
}

dbConnect();
$result = mysql_query("SELECT * FROM application WHERE srno = " . $KEY . " AND cancelflag=0");
if(!mysql_num_rows($result) || mysql_error()){
    echo '<meta http-equiv="refresh" content="0; url=invoice_search.php">';
    die();
}

while($row = mysql_fetch_array($result))
{
    $SrNo = $row['srno'];
    $AppDate = $row['appdate']; 
    $Name = $row['name'];
    $Address = $row['address'];
    $Landline = $row['landline'];
    $Mobile = $row['mobile'];
    $HotelName = $row['hotelname'];
    $RoomType = $row['roomtype'];
    $PaxNos = $row['paxnos'];    
    $ChkIn = $row['chkin'];
    $ChkOut = $row['chkout'];
    $NightsNos = $row['nightsnos'];
    $RoomNos = $row['roomnos'];
    $ConfirmedWith = $row['confirmedwith'];
    $BookingAmt = $row['bookingamt'];
    $SCharge = $row['scharge'];
    $STax = $row['stax'];
    $LTax = $row['ltax'];
    $TotalAmt = $row['totalamt'];
    $AtndBy = decrypt($_COOKIE['SmarTourID'], $Salt);
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
    $Logo = $row['companylogo'];
}
$result = mysql_query("SELECT * FROM hotellist WHERE name = '" . $HotelName . "'");
while($row = mysql_fetch_array($result))
{
    $HName = $row['name'];
    $HAddress = $row['address'];
    $HCity = $row['city'];
    $HPincode = $row['pincode'];
    $HLandline = $row['landline'];
    $HMobile = $row['mobile'];
    $HChkIn = $row['chkin'];
    $HChkOut = $row['chkout'];
}	
mysql_free_result($result);
?>
<!DOCTYPE html>
<html style="background-color: #ccc;">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="images/favicon_main.ico" type="image/x-icon">
        <title>Invoice</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <style type="text/css">
            tr:nth-child(even) {
                background-color: #f1f1f1;
            }
            tr:nth-last-child(1) {
                background: #ffe3e3;
                text-align: center;
            }
        </style>
    </head>
    <body class="metrouicss" style="height: 11.69in;width: 8.27in;margin: auto;padding: 20px;background-color: #fff;box-shadow: 0 0 15px #999;-webkit-box-shadow: 0 0 15px #999;-moz-box-shadow: 0 0 15px #999;">
        <div style="width: 25%;overflow: auto;float: left;text-align: center;">
            <img src="<?php echo $Logo; ?>" style="width: 90%;" />
            <p>Agency Slogan</p>
        </div>
        <div style="width: 75%;padding-left: 15px;overflow: auto;float: left;border-left: 1px solid #ddd;">
            <h2 style="margin: 0 0 7px 0;"><strong><?php echo $CName; ?></strong></h2><p><?php echo $CAddress; ?></p><p><strong>Contact:</strong> <?php echo $CContact; ?> <strong>Mobile:</strong> <?php echo $CMobile; ?></p><p><strong>Email:</strong> <?php echo $CEmail; ?> <strong>Website:</strong> <?php echo $CWebsite; ?></p>
        </div>
        <div style="width: 100%;float: left;padding: 5px;background: #0070b1;">
            <p class="fg-color-white" style="margin: 0;"><span style="width: 24%;float: left;"><strong>Invoice No. <?php echo $SrNo; ?></strong></span>|<span style="padding-left: 12px;"><strong><?php echo date("F j, Y, g:i a"); ?></strong></span></p>
        </div>
        <div style="width: 100%;float: left;padding: 10px;border-bottom: 1px solid #ddd;">
            <p><strong><?php echo $Name; ?></strong></p>
            <p><?php echo $Address; ?></p>
            <p style="margin: 0;">Landline: <?php echo $Landline ?> Mobile: <?php echo $Mobile; ?></p>    
        </div>
        <div style="width: 100%;float: left;padding: 10px;border-bottom: 1px solid #ddd;">
            <p><strong>Booking Details</strong></p>
            <table>
                <tr><td style="width: 50%;">Hotel Name</td><td><?php echo $HName;?></td></tr>
                <tr><td>Room Type</td><td><?php echo $RoomType;?></td></tr>
                <tr><td>Check In</td><td><?php echo $ChkIn . ' (' . $HChkIn . ')' ?></td></tr>
                <tr><td>Check Out</td><td><?php echo $ChkOut . ' (' . $HChkOut . ')' ?></td></tr>
                <tr><td>No. of Nights</td><td><?php echo $NightsNos; ?></td></tr>
                <tr><td>No. of Rooms</td><td><?php echo $RoomNos; ?></td></tr>
                <tr><td>No. of Persons</td><td><?php echo $PaxNos; ?></td></tr>
                <tr><td>Booking Amount</td><td style="text-align: right"><span style="font-family: DejaVu Sans;">&#x20b9;</span><?php echo number_format($BookingAmt, 2, '.', ''); ?></td></tr>
                <tr><td>Service Charge</td><td style="text-align: right"><span style="font-family: DejaVu Sans;">&#x20b9;</span><?php echo number_format($SCharge, 2, '.', ''); ?></td></tr>
                <tr><td>Service Tax</td><td style="text-align: right"><span style="font-family: DejaVu Sans;">&#x20b9;</span><?php echo number_format($STax, 2, '.', ''); ?></td></tr>
                <tr><td>Luxury Tax</td><td style="text-align: right"><span style="font-family: DejaVu Sans;">&#x20b9;</span><?php echo number_format($LTax, 2, '.', '');; ?></td></tr>
                <tr><td><strong>Total Amount</strong></td><td style="text-align: right"><strong><span style="font-family: DejaVu Sans;">&#x20b9;</span><?php echo number_format($BookingAmt+$SCharge+$STax+$LTax, 2, '.', '');?></strong></td></tr>
                <tr><td colspan="2" style="padding: 10px;">In words: Rupees <?php echo numtoword(round($BookingAmt+$SCharge+$STax+$LTax)); ?> only (rounded-off)</td></tr>
            </table>
            <p style="text-align: justify;"><strong>Important:</strong> Please make the total amount payable to <?php echo $CName; ?> if you are issuing a cheque. Once received, you will receive a payment receipt. Payment is due within 30 days from the date of this invoice. Late payments are subject to a 5% late charge.</p>
        </div>
        <div style="width: 100%;float: left;padding: 10px;">
            <p><strong>Remarks: </strong></p>
            <p style="border-bottom: 2px dotted #ccc;">&nbsp;</p>
            <p style="border-bottom: 2px dotted #ccc;">&nbsp;</p>
        </div>
        <div style="width: 100%;height: 100px;padding: 10px;text-align: right;float: left;border-bottom: 1px solid #ddd;">
            <p><strong>For <?php echo $CName; ?></strong></p><br>
            <p><strong>Authorized Signatory</strong></p>
        </div>
        <div style="width: 100%;padding: 10px;text-align: center;float: left;">
            <p>Join us on facebook: <?php echo $FBURL; ?></p>
            <p>Busy since 1996 | Fully Computerized Office | 400+ Hotels | 100+ Destinations</p>
        </div>
        
    </body>
</html>
