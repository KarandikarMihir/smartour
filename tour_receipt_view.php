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
$result = mysql_query("SELECT tour_receipt.srno as rno, tour_receipt.amount, tour_receipt.timestamp, tour_receipt.paymode, tour_receipt.chqbank, tour_receipt.chqnum, tour_receipt.chqdate, tour_receipt.cardtype, "
        . "application_tour.srno as ano, application_tour.seats, tour.name as tname, tour.price, tour.stax, tour.tourdate, customer.name as cname FROM tour, tour_receipt, application_tour, customer "
        . "WHERE tour_receipt.srno=$KEY and tour_receipt.aid=application_tour.srno and application_tour.tid=tour.srno and application_tour.cid=customer.srno") or die(mysql_error());
if(!mysql_num_rows($result)){
    echo '<meta http-equiv="refresh" content="0; url=tour_booking_receipt.php">';
    die();
}

while($row = mysql_fetch_array($result))
{
    $RcptSrno = $row['rno'];
    $Amount = $row['amount'];
    $TimeStamp = $row['timestamp'];
    $PayMode = $row['paymode'];
    $ChqBank = $row['chqbank'];
    $ChqNum = $row['chqnum'];
    $ChqDate = $row['chqdate'];
    $CardType = $row['cardtype'];
    $AppNo = $row['ano'];
    $Seats = $row['seats'];
    $TourName = $row['tname'];
    $Price = $row['price'];
    $STax=$row['stax'];
    $TotalAmt = ($Seats*$Price)+($Seats*$STax);
    $TourDate = $row['tourdate'];
    $TourDate = date("d M Y", strtotime($TourDate));
    $CusName = $row['cname'];
    $HotelName = $row['hotelname'];
}
$result = mysql_query("SELECT * FROM params") or die(mysql_error());
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
        <title>Tour Receipt No. <?php echo $RcptSrno; ?></title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/grids.css">
        <link rel="stylesheet" type="text/css" href="css/grids-responsive.css">
        <style type="text/css">
            tr:nth-child(even) {
                background-color: #f1f1f1;
            }
            body{
                height: 11.69in;
                width: 8.27in;
                margin: auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 15px #999;
                -webkit-box-shadow: 0 0 15px #999;
                -moz-box-shadow: 0 0 15px #999;
            }
            p{
                margin-bottom: 5px !important;
            }
            .margin0{
                margin: 0 !important;
            }
        </style>        
    </head>
    <body class="metrouicss" style="position: relative;">
        <p style="position: absolute;display: inline;top: 20px;right: 20px;border: 2px solid #999;border-radius: 3px;padding: 3px 5px;"><b>Customer Copy</b></p>
        <div class="pure-g">
            <div class="pure-u-1-4 text-center">
                <img src="images/mt.png" alt="logo" style="width: 100%;" />
            </div>
            <div class="pure-u-3-4" style="padding-left: 30px;">
                <h2 style="margin: 0 0 7px 0;"><b><?php echo $CName; ?></b></h2>
                <p><?php echo $CAddress; ?></p>
                <p><b>Landline:</b> <?php echo $CContact; ?> <b>Mobile:</b> <?php echo $CMobile; ?></p>
                <p><b>Email:</b> <?php echo $CEmail; ?> <b>Website:</b> <?php echo $CWebsite; ?></p>              
            </div>
            <div class="pure-u-1" style="background: #0070b1;margin-top: 7px;">
                <div class="pure-g">
                    <div class="pure-u-1-4" style="padding: 3px 10px;">
                        <p class="margin0 fg-color-white"><b>Receipt No. <?php echo $RcptSrno; ?></b></p>
                    </div>
                    <div class="pure-u-3-4" style="padding: 3px 10px 3px 30px;">
                        <p class="margin0 fg-color-white"><b>STC No. <?php echo $TCNumber; ?></b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pure-g" style="margin-top: 10px;">
            <div class="pure-u-1" style="padding: 5px 10px;border: 1px solid #ccc;-webkit-border-radius: 3px;">
                <p class="margin0">Received with thanks from Mr./Mrs./Ms. <strong><?php echo $CusName; ?></strong>, for the tour booking of <strong><?php echo $TourName; ?></strong> On <strong><?php echo $TourDate; ?></strong> (Booking Amount: <strong>Rs. <?php echo $TotalAmt; ?></strong>)</p>                
            </div>
            <div class="pure-u-1" style="margin-top: 10px;">
                <table>
                    <tr>
                        <td>Ticket/Bill No.</td>
                        <td><?php echo $AppNo; ?></td>
                    </tr>
                    <tr>
                        <td>Payment Mode</td>
                        <td><?php echo getMode($PayMode); ?></td>
                    </tr>
                    <tr><td>Bank Details</td><td><?php if($PayMode==2){echo $ChqBank;} else echo 'NA'; ?></td></tr>
                    <tr><td>Cheque Date</td><td><?php if($PayMode==2){echo date("d M Y", strtotime($ChqDate));} else echo 'NA'; ?></td></tr>
                    <tr><td>Cheque Number</td><td><?php if($PayMode==2){echo $ChqNum;} else echo 'NA'; ?></td></tr>
                    <tr><td>Card Type</td><td><?php if($PayMode==3){echo getCardType($CardType);} else echo 'NA'; ?></td></tr>
                    <tr><td><strong>Receipt Amount</strong></td><td><strong>Rs. <?php echo number_format($Amount, 2, '.', '');?></strong></td></tr>
                    <tr><td colspan="2">In words: Rupees <?php echo numtoword(round($Amount)); ?> only (rounded-off)</td></tr>
                    <tr><td colspan="2">Note: Cheque subject to realization. We reserve the right to cancel the booking for non-receipt of full payment and refund will be paid after deducting cancellation and service charges.</td></tr>
                </table>                
            </div>
            <div class="pure-u-1"  style="margin: 10px 0 10px 0;text-align: right;">
                <p><strong>For <?php echo $CName; ?></strong></p><br>
                <p><strong>Authorized Signatory</strong></p>                
            </div>
        </div>
        <hr style="margin: 15px 0;border: 1px dashed #000;">
        <div class="pure-g">
            <div class="pure-u-3-4">
                <h2 style="margin: 0;"><b>Mihir Tourism</b></h2>
            </div>
            <div class="pure-u-1-4" style="position: relative;">
                <p style="float: right;border: 2px solid #999;border-radius: 3px;padding: 3px 5px;"><b>Account Copy</b></p>
            </div>
        </div>        
        <div class="pure-g" style="margin-top: 10px;">
            <div class="pure-u-1" style="padding: 5px 10px;border: 1px solid #ccc;-webkit-border-radius: 3px;">
                <p class="margin0">Received with thanks from Mr./Mrs./Ms. <strong><?php echo $CusName; ?></strong>, for the tour booking at <strong><?php echo $TourName; ?></strong> On <strong><?php echo $TourDate; ?></strong> (Booking Amount: <strong>Rs. <?php echo $TotalAmt; ?></strong>)</p>                
            </div>
            <div class="pure-u-1" style="margin-top: 10px;">
                <table style="margin: 0;">
                    <tr>
                        <td>Receipt No.</td>
                        <td><?php echo $RcptSrno; ?></td>
                    </tr>
                    <tr>
                        <td>Ticket/Bill No.</td>
                        <td><?php echo $AppNo; ?></td>
                    </tr>                    
                    <tr>
                        <td>Payment Mode</td>
                        <td><?php echo getMode($PayMode); ?></td>
                    </tr>
                    <tr><td>Bank Details</td><td><?php if($PayMode==2){echo $ChqBank;} else echo 'NA'; ?></td></tr>
                    <tr><td>Cheque Date</td><td><?php if($PayMode==2){echo date("d M Y", strtotime($ChqDate));} else echo 'NA'; ?></td></tr>
                    <tr><td>Cheque Number</td><td><?php if($PayMode==2){echo $ChqNum;} else echo 'NA'; ?></td></tr>
                    <tr><td>Card Type</td><td><?php if($PayMode==3){echo getCardType($CardType);} else echo 'NA'; ?></td></tr>
                    <tr><td><strong>Receipt Amount</strong></td><td><strong>Rs. <?php echo number_format($Amount, 2, '.', '');?></strong></td></tr>
                    <tr><td colspan="2">In words: Rupees <?php echo numtoword(round($Amount)); ?> only (rounded-off)</td></tr>
                </table>                
            </div>
            <div class="pure-u-1"  style="margin: 10px 0 10px 0;text-align: right;">
                <p><strong>For <?php echo $CName; ?></strong></p><br>
                <p><strong>Authorized Signatory</strong></p>                
            </div>
        </div>        
    </body>
</html>
