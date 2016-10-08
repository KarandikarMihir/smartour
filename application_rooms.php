<?php include 'header.php'; ?>
<?php
if (isset($_GET['KEY']) && is_whole($_GET['KEY'])) {
    $KEY = $_GET['KEY'];
} else {
    echo '<meta http-equiv="refresh" content="0; url=application.php">';
    die();
}
if ($_POST) {
    dbConnect();
    
    $RoomType = $_POST['roomtype'];
    $ChkIn = $_POST['chkin'];
    $ChkOut = $_POST['chkout'];
    $RoomNos = $_POST['roomnos'];
    $PaxNos = $_POST['paxnos'];
    $ExtraPax = $_POST['extrapax'];
    $Basic = $_POST['basic'];
    $Extra = $_POST['extra'];
    $Total = $_POST['total'];
    $username = decrypt($_COOKIE['SmarTourID'],$Salt);
    $userid = namei($username);
    mysql_query("INSERT INTO application_rooms (roomtype,chkin,chkout,roomnos,paxnos,extrapax,basic,extra,total,aid,uid) values('$RoomType','$ChkIn','$ChkOut',$RoomNos,$PaxNos,$ExtraPax,$Basic,$Extra,$Total,$KEY,$userid)");
    
    echo '<meta http-equiv="refresh" content="0; url=application_rooms.php?KEY=' . $KEY . '">';
} else {
    dbConnect();
    $result = mysql_query("SELECT customer.name, application.*, hotellist.name as hotelname, hotellist.srno as hotelsrno FROM application, enquiry, customer, hotellist WHERE enquiry.cid=customer.srno AND enquiry.srno = application.eid AND hotellist.srno = application.hid AND application.srno=" . $KEY) or die(mysql_error());
    if (!mysql_num_rows($result)) {
        echo '<meta http-equiv="refresh" content="0; url=application.php">';
        die();
    }
    while ($row = mysql_fetch_array($result)) {
        $Name = $row['name'];
        $HotelSrno = $row['hotelsrno'];
        $HotelName = $row['hotelname'];
        $PaxNos = $row['paxnos'];
        $FromDate = $row['chkin'];
        $ToDate = $row['chkout'];
        $checkin = intval(substr($row['fromdate'], -2));
        $checkout = intval(substr($row['todate'], -2));
        $difference = $checkout - $checkin;
    }
    mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="application.php"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Room Details: <?php echo $HotelName; ?></h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div id="binder" style="width:100%;height:370px;overflow:auto;">
        <form method="post" action="application_rooms.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
            <div style="float:left;width:200px">
                <p>Room Type</p>
                <div class="input-control text">
                    <input type="text" name="roomtype" list="roomlist" class="validate-name" tabindex="1" autofocus maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />
                    <datalist id="roomlist" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;">
                    <?php
                    dbConnect();
                    $result = mysql_query("SELECT roomtype FROM roomlist WHERE hid=$HotelSrno ORDER BY roomtype") or die(mysql_error());
                    while ($row = mysql_fetch_array($result)) {
                        echo '<option value="' . $row['roomtype'] . '">';
                    }
                    mysql_free_result($result);
                    ?>
                    </datalist>                
                </div>
                <p>Check In (MM-DD-YYYY)</p>
                <div class="input-control text"><input type="date" name="chkin" tabindex="2" min="<?php echo date("Y-m-d"); ?>" onChange="setToDate(this.value, 'chkout');" value="<?php echo $FromDate; ?>" maxlength="10" placeholder="yyyy-mm-dd" style="width:200px;height:34px;"   spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
                <p>Check Out (MM-DD-YYYY)</p>
                <div class="input-control text"><input type="date" name="chkout" tabindex="3" min="<?php echo date("Y-m-d", time() + 86400); ?>" maxlength="10" value="<?php echo $ToDate; ?>" placeholder="yyyy-mm-dd" style="width:200px;height:34px;" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>       
                <p>No. of rooms</p>
                <div class="input-control text"><input type="number" id="roomnos" name="roomnos" tabindex="4" onkeyup="changeTotalForAddRooms();" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>            
                <p>No. of persons</p>
                <div class="input-control text"><input type="number" name="paxnos" tabindex="5"  maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            </div>
            <div id="separator2" style="float:left;width:2%">&nbsp;</div>
            <div style="float:left;width:200px">
                <p>No. of extra persons</p>
                <div class="input-control text"><input type="number" class="skippable" id="extrapax" name="extrapax" tabindex="6" onkeyup="changeTotalForAddRooms();" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Tariff</p>
                <div class="input-control text"><input type="text" id="tariff" name="basic" tabindex="7" onkeyup="changeTotalForAddRooms();" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Extra tariff</p>
                <div class="input-control text"><input type="text" class="amt skippable" id="extraTariff" name="extra" tabindex="8" onkeyup="changeTotalForAddRooms();" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Total</p>
                <div class="input-control text"><input type="text" class="amt" id="roomTotal" name="total" maxlength="50" value="0" readonly spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>&nbsp;</p>
                <p style="text-align:right;"><input type="submit" tabindex="9" name="Add Room" value="Save" style="margin: 0;" /></p>
            </div>
            <div id="separator2" style="float:left;width:2%">&nbsp;</div>
            <div style="float:left;width:800px;">
                <p style="padding: 10px;margin-bottom: 10px;background: #ebebff;border: solid 1px #0000ff;width: 100%;"><span class="label info">Note</span> Add or delete rooms of <b><?php echo $HotelName ?></b> to your application. <a href="application_amount.php?KEY=<?php echo $KEY; ?>">Redirect to Amount Details</a> <i class="icon-new-tab"></i></p>
                <table>
                    <tr>
                        <td colspan="4"><b>Booking Details</b></td>
                    </tr>
                    <tr>
                        <td colspan="2">Applicant's Name</td>
                        <td colspan="2"><?php echo $Name; ?></td>
                    </tr>
                    <tr>
                        <td>Check In</td>
                        <td><?php echo date("d M Y", strtotime($FromDate)); ?></td>
                        <td>Check Out</td>
                        <td><?php echo date("d M Y", strtotime($ToDate)); ?></td>                    
                    </tr>
                </table>
                <table>
                    <tr>
                        <td colspan="7"><b>Room Details</b></td>
                    </tr>
                    <?php
                    $roomresult = mysql_query("SELECT * FROM application_rooms WHERE aid = $KEY") or die(mysql_error());
                    if(!mysql_num_rows($roomresult)){
                        echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
                        echo '</table>';
                    }
                    else{
                    echo '<tr>';
                        echo '<td>Room Type</td>';
                        echo '<td>Check In</td>';
                        echo '<td>Check Out</td>';
                        echo '<td>Pax</td>';
                        echo '<td>Tariff</td>';
                        echo '<td>E. Tariff</td>';
                        echo '<td>Total</td>';
                    echo '</tr>';
                    while($roomrow = mysql_fetch_array($roomresult)){
                        echo '<tr>';
                        echo '<td><a href="javascript:;" onclick="if(confirm(\'Do you want to delete this room?\')){ window.location.href=\'application_rooms_delete.php?KEY=' . $roomrow['srno'] . '&AppID=' . $KEY . '\' } else return false;" title="Click here to delete room">' . $roomrow['roomtype'] . '</a></td>';
                        echo '<td>' . $roomrow['chkin'] . '</td>';
                        echo '<td>' . $roomrow['chkout'] . '</td>';
                        echo '<td>' . $roomrow['paxnos'] . '+' . $roomrow['extrapax'] . '</td>';
                        echo '<td>' . $roomrow['basic'] . '</td>';
                        echo '<td>' . $roomrow['extra'] . '</td>';
                        echo '<td>' . $roomrow['total'] . '</td>';
                        echo '</tr>';
                    }       
                    }
                    ?>
                </table>
            </div>
        </form>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>