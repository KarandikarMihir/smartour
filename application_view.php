<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=application_update.php">';
    die();
}
dbConnect();
$result = mysql_query("SELECT application.timestamp, application.cancelflag, application.uid, customer.name, customer.address, customer.mobile, customer.landline, customer.email FROM application, customer, enquiry WHERE application.srno=$KEY AND application.eid=enquiry.srno AND enquiry.cid=customer.srno") or die(mysql_error());
if(!mysql_num_rows($result)){
    echo '<meta http-equiv="refresh" content="0; url=application.php">';
    die();
}
$row = mysql_fetch_array($result);
$AppDate = $row['timestamp']; 
$Name = $row['name'];
$Address = $row['address'];
$Landline = $row['landline'];
$Mobile = $row['mobile'];
$Email = $row['email'];    
$Uid = $row['uid'];
$Username = iname($Uid);
$CancelFlag= $row['cancelflag'];
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;"><?php echo $Name; ?></h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <?php
    if($CancelFlag)
    {
        echo '<p style="padding: 10px;margin-bottom: 25px;background: #ffebeb;border: solid 1px #FF0000;width: 95%;"><span class="label important">Important!</span> Please note that this application was cancelled.</p>'; 
    }
    ?>
    <div id="binder" style="width:100%;height:320px;overflow:auto;">
        <p style="padding-bottom: 5px;border-bottom: 2px dotted #ccc;display: inline-block;"><b>Application Date:</b> <?php echo $row['timestamp']; ?></p>
        <div class="pure-g">
            <div class="pure-u-1" style="padding-right: 10px;">
                <h3 class="fg-color-red"><b>Customer Info</b></h3>
                <table>
                    <tr>
                        <td><b>Address</b></td>
                        <td><?php echo $Address; ?></td>
                    </tr>
                    <tr>
                        <td><b>Landline</b></td>
                        <td><?php echo $Landline; ?></td>
                    </tr>
                    <tr>
                        <td><b>Mobile</b></td>
                        <td><?php echo $Mobile; ?></td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td><?php echo $Email; ?></td>
                    </tr>            
                </table>
            </div>
            <div class="pure-u-1">
                <h3 class="fg-color-red"><b>Booking Info</b></h3>
                <?php
                dbConnect();
                $result = mysql_query("SELECT hotellist.srno as hid, hotellist.name as hname, citylist.name as cname FROM hotellist, citylist, application_hotel, application WHERE application.srno=$KEY AND application_hotel.aid=application.srno AND application_hotel.hid=hotellist.srno AND hotellist.cityid=citylist.srno ORDER BY hotellist.name ASC") or die(mysql_error());
                if (!mysql_num_rows($result)) {
                    echo '<p><b>No hotel has been added yet.</b></p>';
                }
                else {
                    while ($row = mysql_fetch_array($result)) {
                        echo '<div class="pure-u-1" style="overflow-x: auto;">';
                        echo '<table class="no-wrap">';
                        echo '<tr><td colspan="15" class="fg-color-darkBlue"><b>' . $row['hname'] . ', ' . $row['cname'] . '</b></td></tr>';
                        $result_= mysql_query("SELECT application_rooms.*, useraccounts.username FROM application_rooms, application, useraccounts WHERE application.srno=$KEY AND application_rooms.aid=application.srno AND application_rooms.uid=useraccounts.srno ORDER BY application_rooms.roomtype ASC") or die(mysql_error());
                        if(!mysql_num_rows($result_))
                        {
                            echo '</table>';
                            echo '<p>No room added, yet.</p>';
                        }
                        else{
                            echo '<tr>';
                            echo '<td><b>Room</b></td>';
                            echo '<td><b>No. of Nights</b></td>';
                            echo '<td><b>No. of Rooms</b></td>';
                            echo '<td><b>Total Amount</b></td>';
                            echo '<td><b>Rate</b></td>';
                            echo '<td><b>Amount</b></td>';
                            echo '<td><b>Extra Pax</b></td>';
                            echo '<td><b>Extra Rate</b></td>';
                            echo '<td><b>Extra Amount</b></td>';
                            echo '<td><b>Children</b></td>';
                            echo '<td><b>Child Rate</b></td>';
                            echo '<td><b>Child Amount</b></td>';
                            echo '<td><b>Check-in Date</b></td>';
                            echo '<td><b>Check-out Date</b></td>';
                            echo '<td><b>Added By</b></td>';
                            echo '</tr>';
                            while($row_ = mysql_fetch_array($result_)){
                                echo '<tr class="data">';
                                echo '<td>' . $row_['roomtype'] . '</td>';
                                echo '<td>' . $row_['nightnos'] . '</td>';
                                echo '<td>' . $row_['roomnos'] . '</td>';
                                echo '<td>' . (float)($row_['amount']+$row_['extra_amount']+$row_['child_amount']) . '</td>';
                                echo '<td>' . $row_['rate'] . '</td>';
                                echo '<td>' . $row_['amount'] . '</td>';
                                echo '<td>' . $row_['extrapax'] . '</td>';
                                echo '<td>' . $row_['extra_rate'] . '</td>';
                                echo '<td>' . $row_['extra_amount'] . '</td>';
                                echo '<td>' . $row_['children'] . '</td>';
                                echo '<td>' . $row_['child_rate'] . '</td>';
                                echo '<td>' . $row_['child_amount'] . '</td>';
                                echo '<td>' . date("d M Y", strtotime($row_['chkin'])) . '</td>';
                                echo '<td>' . date("d M Y", strtotime($row_['chkout'])) . '</td>';
                                echo '<td>' . $row_['username'] . '</td>';
                                echo '</tr>';                                        
                            }
                            echo '</table>';
                        }
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <table style="width:80%">
            <tr>
                <td colspan="2"><b>Payment Info</b></td>
            </tr>            
            <tr>
                <td style="width: 200px;">Booking Amount</td>
                <td>Rs. <?php echo $BookingAmt; ?></td>
            </tr>
            <tr>
                <td>Service Charge</td>
                <td>Rs. <?php echo $SCharge; ?></td>
            </tr>
            <tr>
                <td>Service Tax</td>
                <td>Rs. <?php echo $STax; ?></td>
            </tr>
            <tr>
                <td>Luxury Tax</td>
                <td>Rs. <?php echo $LTax; ?></td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td>Rs. <?php echo $TotalAmt; ?></td>
            </tr>
            <tr>
                <td>Attended By</td>
                <td><?php echo $Username; ?></td>
            </tr>
        </table>
    </div>
</div>
<?php include 'footer.html'; ?>