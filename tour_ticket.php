<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=tour_booking.php">';
    die();
}
dbConnect();
$result = mysql_query("SELECT customer.name as cname,customer.address,customer.landline,customer.mobile, customer.email,"
        . "application_tour.srno,application_tour.seats,application_tour.timestamp,"
        . "tour.name as tname, tour.tourdate, tour.price, tour.stax FROM customer, application_tour, tour "
        . "WHERE application_tour.srno = $KEY and application_tour.cid = customer.srno "
        . "and application_tour.tid = tour.srno") or die(mysql_error());
while($row = mysql_fetch_array($result))
{
    $SrNo = $KEY;
    $AppDate = $row['timestamp']; 
    $Name = $row['cname'];
    $Address = $row['address'];
    $Landline = $row['landline'];
    $Mobile = $row['mobile'];
    $Email = $row['email'];
    $TourName = $row['tname'];
    $TourDate = $row['tourdate'];
    $TourDate = date("d M Y", strtotime($TourDate));
    $Seats = $row['seats'];
    $Price = $row['price'];    
    $STax = $row['stax'];
    $Amount = ($Seats*$Price) + ($Seats*$STax);
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
        <title>Ticket/Bill No. <?php echo $SrNo; ?></title>
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
                        <p class="margin0 fg-color-white"><b>Ticket/Bill No. <?php echo $SrNo; ?></b></p>
                    </div>
                    <div class="pure-u-3-4" style="padding: 3px 10px 3px 30px;">
                        <p class="margin0 fg-color-white"><b>STC No. <?php echo $TCNumber; ?></b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pure-g" style="margin-top: 10px;">
            <div class="pure-u-1">
                <table>
                    <tr>
                        <td colspan="2"><b>General Info</b></td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Name</td>
                        <td><?php echo $Name; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $Address; ?></td>
                    </tr>
                    <?php 
                        if($Landline!="" || $Mobile!=""){ 
                            echo '<tr>';
                            echo '<td>Contact:</td>';
                            echo '<td>' . $Landline . ' <span style="margin-left: 10px;">' . $Mobile . '</span></td>';
                            echo '</tr>';
                        } 
                        if($Email!=""){ 
                            echo '<tr>';
                            echo '<td>Email:</td><td>' . $Email . '</td>';
                            echo '</tr>';
                        }                     
                    ?>
                    <tr>
                        <td>Tour Name</td>
                        <td><?php echo $TourName; ?></td>
                    </tr>
                </table>
            </div>
            <div class="pure-u-1-2" style="padding-right: 5px;">
                <table>
                    <tr>
                        <td colspan="2"><b>Booking Info</b></td>
                    </tr>            
                    <tr>
                        <td style="width: 150px;">No. of seats</td>
                        <td><?php echo $Seats; ?></td>
                    </tr>            
                    <tr>
                        <td>Journey Date</td>
                        <td><?php echo $TourDate; ?></td>
                    </tr>            
                    <tr>
                        <td>Journey Time</td>
                        <td>10:00 AM</td>
                    </tr>            
                    <tr>
                        <td>Boarding Place</td>
                        <td>Paud Road, Pune</td>
                    </tr>            
                </table>
            </div>
            <div class="pure-u-1-2" style="padding-left: 5px;">
                <table style="margin: 0;">
                    <tr>
                        <td colspan="2"><b>Payment Info</b></td>
                    </tr>                    
                    <tr>
                        <td>Booking Amount</td>
                        <td style="text-align: right;">Rs. <?php echo number_format($Seats*$Price,2); ?></td>
                    </tr>
                    <tr>
                        <td>Service Tax</td>
                        <td style="text-align: right;">Rs. <?php echo number_format($STax*$Seats,2); ?></td>
                    </tr>
                    <tr>
                        <td><b>Grand Total</b></td>
                        <td style="text-align: right;"><b>Rs. <?php echo number_format($Amount,2); ?></b></td>
                    </tr> 
                </table>
                <p style="padding: 10px;">In words: Rupees <?php echo numtoword($Amount); ?></p>
            </div>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-2" style="padding: 0 10px 0 10px;">
                <p><b>Remarks: </b></p>
                <p style="border-bottom: 2px dotted #ccc;">&nbsp;</p>
                <p style="border-bottom: 2px dotted #ccc;">&nbsp;</p>
            </div>
            <div class="pure-u-1-2">
                <p class="text-right"><b>For <?php echo $CName; ?></b></p><br><br>
                <p class="text-right"><b>Authorized Signatory</b></p>                
            </div>
        </div>
        <p style="border-bottom: 2px dashed #666;">&nbsp;</p>
        <div class="pure-g" style="margin-top: 20px;">
            <div class="pure-u-3-4">
                <h2 style="margin: 0;"><b>Mihir Tourism</b></h2>
            </div>
            <div class="pure-u-1-4" style="position: relative;">
                <p style="float: right;border: 2px solid #999;border-radius: 3px;padding: 3px 5px;"><b>Account Copy</b></p>
            </div>
        </div>
        <div class="pure-g">
            <div class="pure-u-1">
                <table>
                    <tr>
                        <td style="width: 150px;">Ticket/Bill No.</td>
                        <td><?php echo $SrNo; ?></td>
                    </tr>                    
                    <tr>
                        <td style="width: 150px;">Name</td>
                        <td><?php echo $Name; ?></td>
                    </tr>                    
                    <?php 
                        if($Landline!="" || $Mobile!=""){ 
                            echo '<tr>';
                            echo '<td>Contact:</td>';
                            echo '<td>' . $Landline . ' <span style="margin-left: 10px;">' . $Mobile . '</span></td>';
                            echo '</tr>';
                        } 
                        if($Email!=""){ 
                            echo '<tr>';
                            echo '<td>Email:</td><td>' . $Email . '</td>';
                            echo '</tr>';
                        }                     
                    ?>
                    <tr>
                        <td>Tour Name</td>
                        <td><?php echo $TourName; ?></td>
                    </tr>                    
                </table>
            </div>
            <div class="pure-u-1-2" style="padding-right: 5px;">
                <table>
                    <tr>
                        <td colspan="2"><b>Booking Info</b></td>
                    </tr>            
                    <tr>
                        <td style="width: 150px;">No. of seats</td>
                        <td><?php echo $Seats; ?></td>
                    </tr>            
                    <tr>
                        <td>Journey Date</td>
                        <td><?php echo $TourDate; ?></td>
                    </tr>            
                    <tr>
                        <td>Journey Time</td>
                        <td>10:00 AM</td>
                    </tr>            
                    <tr>
                        <td>Boarding Place</td>
                        <td>Paud Road, Pune</td>
                    </tr>            
                </table>
            </div>
            <div class="pure-u-1-2" style="padding-left: 5px;">
                <table style="margin: 0;">
                    <tr>
                        <td colspan="2"><b>Payment Info</b></td>
                    </tr>                    
                    <tr>
                        <td>Booking Amount</td>
                        <td style="text-align: right;">Rs. <?php echo number_format($Seats*$Price,2); ?></td>
                    </tr>
                    <tr>
                        <td>Service Tax</td>
                        <td style="text-align: right;">Rs. <?php echo number_format($STax*$Seats,2); ?></td>
                    </tr>
                    <tr>
                        <td><b>Grand Total</b></td>
                        <td style="text-align: right;"><b>Rs. <?php echo number_format($Amount,2); ?></b></td>
                    </tr> 
                </table>
            </div>
        </div>
        <div class="pure-g">
            <div class="pure-u-1">
                <p class="text-right"><b>I agree to the terms and conditions.</b></p><br>
                <p class="text-right"><b>Customer's Signature</b></p>                
            </div>
        </div>          
    </body>
</html>
