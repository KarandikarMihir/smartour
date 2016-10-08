<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
if(isset($_GET['AID']) && is_whole($_GET['AID']) && isset($_GET['HID']) && is_whole($_GET['HID'])){
    $AID = $_GET['AID'];
    $HID = $_GET['HID'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=voucher_search.php">';
    die();
}
dbConnect();
$result = mysql_query("SELECT application_hotel.srno as vid, hotellist.name as hname, citylist.name as cname, application.timestamp, application.cancelflag, application.uid, customer.name, customer.address, customer.mobile, customer.landline, customer.email FROM application, customer, enquiry, application_hotel, hotellist, citylist WHERE application.srno=$AID AND application_hotel.hid=$HID AND application_hotel.aid=application.srno AND application_hotel.hid=hotellist.srno AND hotellist.cityid=citylist.srno AND application.eid=enquiry.srno AND enquiry.cid=customer.srno") or die(mysql_error());
if(!mysql_num_rows($result) || mysql_error()){
    echo '<meta http-equiv="refresh" content="0; url=voucher_search.php">';
    die();
}
$row = mysql_fetch_array($result);
$Vid = $row['vid'];
$HotelName = $row['hname'];
$HotelCity = $row['cname'];
$AppDate = $row['timestamp']; 
$Name = $row['name'];
$Address = $row['address'];
$Landline = $row['landline'];
$Mobile = $row['mobile'];
$Email = $row['email'];    
$Uid = $row['uid'];
$Username = iname($Uid);
$CancelFlag= $row['cancelflag'];

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
        <title>Voucher</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/grids.css">
        <link rel="stylesheet" type="text/css" href="css/grids-responsive.css">        
        <style type="text/css">
            .compact td{
                font-size: 10pt !important;
                padding: 1px 6px !important;
            }
/*            tr:nth-child(even) {
                background-color: #f1f1f1;
            }*/
            .printable{
                height: 11.69in;
                width: 8.27in;
                margin: auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 15px #999;
                -webkit-box-shadow: 0 0 15px #999;
                -moz-box-shadow: 0 0 15px #999;
                box-shadow: 0 0 15px #999;
            }
            td b{
                color: rgba(0,0,0,0.9);
            }
            td{
                color: #000 !important;
            }
/*            tr:nth-last-child(1) {
                background: #ffe3e3;
                text-align: center;
            }*/
        </style>        
    </head>
    <body class="metrouicss printable">
        <div class="pure-g">
            <div class="pure-u-1-4" style="background: url('<?php echo $Logo; ?>');background-repeat: no-repeat;height: 100px;background-position: 50% 50%;background-size: contain;">
                
            </div>
            <div class="pure-u-3-4" style="padding-left: 20px;">
                <h2 style="margin: 0 0 7px 0;"><b><?php echo $CName; ?></b></h2>
                <p><?php echo $CAddress; ?></p>
                <p><b>Contact:</b> <?php echo $CContact; ?> <b>Mobile:</b> <?php echo $CMobile; ?></p>
                <p><b>Email:</b> <?php echo $CEmail; ?> <b>Website:</b> <?php echo $CWebsite; ?></p>                
            </div>
        </div>
        <div class="pure-g">
            <div class="pure-u-1" style="padding: 5px;border: 1px solid #000;border-radius: 3px;">
                <div class="pure-g">
                    <div class="pure-u-1-4">
                        <p style="margin: 0;"><b>Voucher No. <?php echo $Vid; ?></b></p>
                    </div>
                    <div class="pure-u-1-2" style="padding-left: 17px;">
                        <p style="margin: 0;"><b><?php echo $HotelName . ', ' . $HotelCity; ?></b></p>
                    </div>
                    <div class="pure-u-1-4">
                        <p style="margin: 0;"><b>Application No. <?php echo $AID; ?></b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-2" style="padding: 20px 10px;">
                <p><b>To,<br>The Manager,<br><?php echo $HotelName; ?>,<br><?php echo $HotelCity; ?>.</b></p>
                <p>Kindly accommodate the customer as per the details mentioned below.</p>
            </div>
            <div class="pure-u-1-2" style="margin-top: 20px;">
                <table class="striped">
                    <tr>
                        <td colspan="2"><b>Customer Info</b></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $Name; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $Address; ?></td>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td><?php if($Landline) echo $Landline . ', '; if($Mobile) echo $Mobile; ?></td>
                    </tr>
                </table>
            </div>
            <div class="pure-u-1">
                <table class="striped">
                    <tr>
                        <td><b>Booking Info</b></td>
                    </tr>
                </table>
                    <?php
                    dbConnect();
                    $result_= mysql_query("SELECT application_rooms.*, useraccounts.username FROM application_rooms, application, useraccounts WHERE application.srno=$AID AND application_rooms.aid=application.srno AND application_rooms.uid=useraccounts.srno AND application_rooms.hid=$HID ORDER BY application_rooms.roomtype ASC") or die(mysql_error());
                    if(!mysql_num_rows($result_))
                    {
                        echo '<p>No room added, yet.</p>';
                    }
                    else {
                        while ($row_ = mysql_fetch_array($result_)) {
                            echo '<table class="compact">';
                            echo '<tr>';
                            echo '<td style="min-width: 100px;"><b>Room</b></td>';
                            echo '<td><b>Check-in</b></td>';
                            echo '<td><b>Check-out</b></td>';
                            echo '<td><b>No. of Nights</b></td>';
                            echo '<td><b>No. of Rooms</b></td>';
                            echo '<td><b>No. of Persons</b></td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>' . $row_['roomtype'] . '</td>';
                            echo '<td>' . date("d M Y", strtotime($row_['chkin'])) . '</td>';
                            echo '<td>' . date("d M Y", strtotime($row_['chkout'])) . '</td>';
                            echo '<td>' . $row_['nightnos'] . '</td>';
                            echo '<td>' . $row_['roomnos'] . '</td>';
                            echo '<td>0</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><b>Rate</b></td>';
                            echo '<td><b>Amount</b></td>';
                            echo '<td><b>Extra</b></td>';
                            echo '<td><b>Children</b></td>';
                            echo '<td><b>Total Amount</b></td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>' . $row_['rate'] . '</td>';
                            echo '<td>' . $row_['amount'] . '</td>';
                            echo '<td>' . $row_['extra_rate'] . ' x ' . $row_['extrapax'] . '</td>';
                            echo '<td>' . $row_['child_rate'] . ' x ' . $row_['children'] . '</td>';
                            echo '<td>' . (float) ($row_['amount'] + $row_['extra_amount'] + $row_['child_amount']) . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '</tr>';
                            echo '</tr>';
                            echo '</table>';
                        }
                    }
                    ?>
            </div>
        </div>
        <table>
            <tr>
                <td colspan="2"><b>Payment Info</b></td>
            </tr>            
            <tr>
                <td style="width: 200px;">Booking Amount</td>
                <td style="text-align: right;"><?php echo number_format($BookingAmt, 2); ?></td>
            </tr>
            <tr>
                <td>Luxury Tax</td>
                <td style="text-align: right;"><?php echo number_format($LTax, 2); ?></td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td style="text-align: right;"><?php echo number_format($TotalAmt, 2); ?></td>
            </tr>
        </table>
        <div style="width: 100%;float: left;padding: 10px;">
            <p><b>Remarks: </b></p>
            <p style="border-bottom: 2px dotted #ccc;">&nbsp;</p>
        </div>      
        <div style="width: 100%;overflow: auto;padding: 0 10px 10px 10px;text-align: right;float: left;border-bottom: 1px solid #ddd;">
            <p><b>For <?php echo $CName; ?></b></p><br>
            <p style="margin: 0;"><b>Authorized Signatory</b></p>
        </div>
        <div style="width: 100%;overflow: auto;padding: 20px 10px 10px 10px;text-align: center;float: left;">
            <p>Join us on facebook: <?php echo $FBURL; ?></p>
            <p>Busy since 1996 | Fully Computerized Office | 400+ Hotels | 100+ Destinations</p>
        </div>        
    </body>
</html>
