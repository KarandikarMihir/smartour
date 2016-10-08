<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=feedback.php">';
    die();
}
if($_POST)
{
    dbConnect();
    $q1 = SafeString($_POST['qstn1']);
    $q2 = SafeString($_POST['qstn2']);
    $q3 = SafeString($_POST['qstn3']);
    $q4 = SafeString($_POST['qstn4']);
    $Remarks = SafeString($_POST['remarks']);
    mysql_query("INSERT INTO feedback VALUES('" . $q1 . "','" . $q2 . "','" . $q3 . "','" . $q4 . "','" . $Remarks . "'," . $KEY . ")") or die(mysql_error());
    mysql_query("UPDATE application set feedbackflag=1 WHERE srno=" . $KEY) or die(mysql_error());
    
    $MaxSr = mysql_query("SELECT MAX(srno) FROM activitylog") or die(mysql_error());
    $MaxSr = mysql_fetch_array($MaxSr, MYSQL_BOTH);
    $MaxSr = intval($MaxSr[0]) + 1;
    mysql_query("INSERT INTO activitylog VALUES($MaxSr, 'Feedback submitted for Application No. $KEY','" . date('D, d-M-Y H-i-s T') . "','" . decrypt($_COOKIE['SmarTourID'], $Salt) . "')") or die(mysql_error());
    //header('location: feedback.php');
    echo '<meta http-equiv="refresh" content="0; url=feedback.php">';
}
else
{
    
    dbConnect();
    $result = mysql_query("SELECT * FROM application WHERE srno = " . $KEY);
    if(!mysql_num_rows($result) || mysql_error()){
        echo '<meta http-equiv="refresh" content="0; url=feedback.php">';
        die();
    }
    
    while($row = mysql_fetch_array($result))
    {
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
        $ConfirmedWith = $row['confirmedwith'];
        $BookingAmt = $row['bookingamt'];
        $SCharge = $row['scharge'];
        $STax = $row['stax'];
        $LTax = $row['ltax'];
        $TotalAmt = $row['totalamt'];
        $AtndBy = decrypt($_COOKIE['SmarTourID'], $Salt);
    }
    mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;"><?php echo $Name; ?></h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div id="policytext" style="width:100%;height:320px;overflow:auto;">
        <div style="width:50%;float:left;">
            <h2>Quick Info</h2>
             <table style="width:90%">
                 <tr>
                     <td style="width:40%;">Address</td>
                    <td><?php echo $Address; ?></td>
                </tr>
                <tr>
                    <td>Landline</td>
                    <td><?php echo $Landline; ?></td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td><?php echo $Mobile; ?></td>
                </tr>
                <tr>
                    <td>Hotel Name</td>
                    <td><?php echo $HotelName; ?></td>
                </tr>
                <tr>
                    <td>Room Type</td>
                    <td><?php echo $RoomType; ?></td>
                </tr>
                <tr>
                    <td>Pax</td>
                    <td><?php echo $PaxNos; ?></td>
                </tr>
                <tr>
                    <td>Check In</td>
                    <td><?php echo $ChkIn; ?></td>
                </tr>
                <tr>
                    <td>Check Out</td>
                    <td><?php echo $ChkOut; ?></td>
                </tr>
                <tr>
                    <td>No. of Nights</td>
                    <td><?php echo $NightsNos; ?></td>
                </tr>
             </table>
        </div>
        <div style="float:left;">
            <form method="post" action="feedback_form.php?KEY=<?php echo $KEY; ?>">
                <h2>Feedback Form</h2>
                <p>Are you a regular customer of Mihir Tourism?</p>
                <label class="input-control radio">
                    <input type="radio" name="qstn1" value="Yes" required>
                    <span class="helper">Yes</span>
                </label>
                <label class="input-control radio">
                    <input type="radio" name="qstn1" value="No">
                    <span class="helper">No</span>
                </label>
                <p>Are you satisfied with our service?</p>
                <label class="input-control radio">
                    <input type="radio" name="qstn2" value="Yes" required>
                    <span class="helper">Yes</span>
                </label>
                <label class="input-control radio">
                    <input type="radio" name="qstn2" value="No">
                    <span class="helper">No</span>
                </label>
                <p>Are you satisfied with the hotel's service?</p>
                <label class="input-control radio">
                    <input type="radio" name="qstn3" value="Yes" required>
                    <span class="helper">Yes</span>
                </label>
                <label class="input-control radio">
                    <input type="radio" name="qstn3" value="No">
                    <span class="helper">No</span>
                </label>
                <p>Whether sufficient information was provided?</p>
                <label class="input-control radio">
                    <input type="radio" name="qstn4" value="Yes" required>
                    <span class="helper">Yes</span>
                </label>
                <label class="input-control radio">
                    <input type="radio" name="qstn4" value="No">
                    <span class="helper">No</span>
                </label>
                <p>Specific comments (if any)</p>
                <div class="input-control textarea">
                    <textarea name="remarks" placeholder="..the remarks go here" required style="max-height:20px;max-width: 500px;font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;"></textarea>
                </div>
                <p>*Please note that feedback form cannot be deleted, altered or created anew.</p>
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>