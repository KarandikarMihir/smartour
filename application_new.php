<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
//    dbConnect();
//    $result_ = mysql_query("SELECT applock FROM enquiry WHERE srno = $KEY") or die(mysql_error());
//    $row_ = mysql_fetch_array($result_);
//    if($row_['applock']=="1"){
//        echo '<meta http-equiv="refresh" content="0; url=application.php">';
//        die();
//    }
}
else{
    echo '<meta http-equiv="refresh" content="0; url=application.php">';
    die();
}
if($_POST)
{
    dbConnect();
    $Hotel = SafeString($_POST['hotel']);
    $PaxNos = SafeString($_POST['paxnos']);    
    $ChkIn = SafeString($_POST['chkin']);
    $ChkOut = SafeString($_POST['chkout']);
    $NightsNos = SafeString($_POST['nightsnos']);
    $ConfirmedWith = SafeString($_POST['conwith']);
    $username = decrypt($_COOKIE['SmarTourID'], $Salt);
    $uid = namei($username);
    
    mysql_query("INSERT INTO application(paxnos, chkin, chkout, nights, confirmedwith, hid, eid, uid) VALUES(" . $PaxNos . ",'" . $ChkIn . "','" . $ChkOut . "'," . $NightsNos . ",'" . $ConfirmedWith . "'," . $Hotel . "," . $KEY ."," . $uid . ")") or die(mysql_error());
    mysql_query("UPDATE enquiry set applock=1 WHERE srno=$KEY") or die(mysql_error());

    $result=mysql_query("SELECT * FROM application WHERE uid=$uid ORDER BY srno DESC LIMIT 1") or die(mysql_error());
    $row=  mysql_fetch_array($result);
    //header('location: application.php');
    echo '<meta http-equiv="refresh" content="0; url=application_rooms.php?KEY=' . $row['srno'] . '">';
}
else
{
    dbConnect();
    $result = mysql_query("SELECT enquiry.*, customer.* FROM enquiry, customer, citylist WHERE enquiry.cid=customer.srno AND enquiry.srno = " . $KEY) or die(mysql_error());
    if(!mysql_num_rows($result)){
        echo '<meta http-equiv="refresh" content="0; url=application.php">';
        die();
    }    
    while($row = mysql_fetch_array($result))
    {
        $Destination = $row['destination'];
        $Name = $row['name'];
        $Address = $row['address'];
        $Landline = $row['landline'];
        $Mobile = $row['mobile'];
        $PaxNos = $row['paxnos'];
        $FromDate = $row['fromdate'];
        $ToDate = $row['todate'];
        $checkin=intval(substr($row['fromdate'], -2));
        $checkout=intval(substr($row['todate'], -2));
        $difference=$checkout-$checkin;
    }
    mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">New Application</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div id="binder" style="width:100%;height:350px;overflow:auto;">
        <div class="pure-g" style="padding-right: 10px;overflow: hidden;">
            <div class="pure-u-1" style="">
                <div class="pure-g">
                    <div class="pure-u-1-3" style="border-right: 2px dotted #ccc;padding-right: 10px;">
                        <h2 class="fg-color-redLight" style="border-bottom: 2px dotted #ccc;display: inline-block;"><?php echo $Name; ?></h2>
                        <table>
                            <tr>
                                <td><b>Destination</b></td>
                                <td><?php echo $Destination; ?></td>
                            </tr>
                            <tr>
                                <td><b>No. of persons</b></td>
                                <td><?php echo $PaxNos; ?></td>
                            </tr>
                            <tr>
                                <td><b>Check In</b></td>
                                <td><?php echo date("d M Y", strtotime($FromDate));  ?></td>
                            </tr>
                            <tr>
                                <td><b>Check Out</b></td>
                                <td><?php echo date("d M Y", strtotime($ToDate));  ?></td>
                            </tr>                            
                        </table>
                        <p class="fg-color-greenDark"><b>Add a hotel</b></p>
                        <div class="input-control select">
                            <select name="hotel" style="padding: 4px;width: 90%;margin: 0;" id="apphotel">
                                <?php
                                    dbConnect();
                                    $result=mysql_query("SELECT hotellist.srno, hotellist.name as hname, citylist.name as cname FROM hotellist, citylist WHERE hotellist.cityid=citylist.srno ORDER BY hotellist.name ASC") or die(mysql_error());
                                    $row=  mysql_fetch_array($result);
                                    $ref=$row['srno'];
                                    do
                                    {
                                            echo '<option value="' . $row['srno'] . '">' . $row['hname'] . ', ' . $row['cname'] . '</option>';
                                    }
                                    while($row = mysql_fetch_array($result));
                                    mysql_free_result($result);
                                ?>
                            </select>
                            <i class="icon-plus fg-color-green" style="cursor: pointer;font-size: 100%;" title="Add" onclick="addHotel(<?php echo $KEY; ?>);"></i>
                        </div>                        
                    </div>
                    <div class="pure-u-2-3" style="padding-left: 10px;">
                        <?php
                        dbConnect();
                        $result = mysql_query("SELECT hotellist.srno as hid, hotellist.name as hname, citylist.name as cname FROM hotellist, citylist, application_hotel, application WHERE application.eid=$KEY AND application_hotel.aid=application.srno AND application_hotel.hid=hotellist.srno AND hotellist.cityid=citylist.srno ORDER BY hotellist.name ASC") or die(mysql_error());
                        if(!mysql_num_rows($result))
                        {
                            echo '<p><b>No hotel has been added yet.</b></p>';
                        }
                        else
                        {
                            while($row = mysql_fetch_array($result))
                            {
                                echo '<p class="fg-color-blueDark"><b>' . $row['hname'] . ', ' . $row['cname'] . '</b> <span class="fg-color-redLight" style="float: right;cursor: pointer;" onclick="if(confirm(\'Click OK to confirm action\')){removeHotel(\'' . $row['hid'] . '\', \'' . $KEY . '\');} else return false;">[Remove hotel]</span></p>';
                                echo '<div class="pure-u-1" style="overflow-x: auto;">';
                                $result_=mysql_query("SELECT application_rooms.*, useraccounts.username FROM application_rooms, application, useraccounts WHERE application.eid=$KEY AND application_rooms.aid=application.srno AND application_rooms.uid=useraccounts.srno AND application_rooms.hid=" . (int)$row['hid'] . " ORDER BY application_rooms.roomtype ASC") or die(mysql_error());
                                if(!mysql_num_rows($result_))
                                {
                                    echo '<table class="no-wrap" style="margin: 0;">';
                                    echo '<tr><td><h3 style="text-align: center;">***No Room Added***</h3></td></tr>';
                                    echo '</table>';
                                }
                                else{
                                    echo '<table class="no-wrap">';
                                    echo '<tr>';
                                    echo '<td></td>';
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
                                        echo '<td><i class="icon-minus fg-color-redLight" style="cursor: pointer;" title="Delete Room" onclick="if(confirm(\'Click OK to confirm action\')){removeRoom(\'' . $row_['srno'] . '\');} else return false;"></i></td>';
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
                                echo '<form method="post" action="application_new.php" class="roomform">';
                                echo '<div class="pure-g mygrid" style="margin-top: 20px;">';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Room Type</p>';
                                echo '<div class="input-control text">';
                                echo '<input type="text" class="validate-name" list="roomlist_' . $row['hid'] . '" placeholder="Press &darr; to expand" autofocus tabindex="1" name="roomtype" maxlength="25" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/>';
                                echo '<datalist id="roomlist_' . $row['hid'] . '">';
                                    $_result=mysql_query("SELECT roomlist.roomtype FROM roomlist WHERE roomlist.hid=" . $row['hid'] . " ORDER BY roomlist.roomtype ASC") or die(mysql_error());
                                    while($_row = mysql_fetch_array($_result))
                                    {
                                        echo '<option value="' . $_row['roomtype'] . '">';
                                    }
                                    mysql_free_result($_result);
                                echo '</datalist>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Check-in</p>';
                                echo '<div class="input-control text">';
                                echo '<input type="date" id="fromdate" name="FromDate" style="height: 34px;" tabindex="2" min="' . date("Y-m-d") . '" onChange="setToDate(this.value,\'ToDate\');" maxlength="10" placeholder="yyyy-mm-dd" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Check-out</p>';
                                echo '<div class="input-control text">';
                                echo '<input type="date" id="todate" name="ToDate" style="height: 34px;" tabindex="3" min="' . date("Y-m-d", time()+86400) . '" maxlength="10" placeholder="yyyy-mm-dd" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>No. of Nights</p>';
                                echo '<div class="input-control text">';
                                echo '<input type="number" id="nightnos" name="nightnos" class="onchangeupdate_basic" tabindex="4" min="1" max="200" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-g mygrid">';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>No. of rooms</p>';
                                echo '<div class="input-control text">';
                                echo '<input type="number" id="roomnos" name="roomnos" class="onchangeupdate_basic" value="1" tabindex="5" min="1" max="200" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Rate Rs.</p>';
                                echo '<div class="input-control text" style="margin: 0;">';
                                echo '<input type="text" id="roomrate" class="amt onchangeupdate_basic" maxlength="10" name="rate" value="0" tabindex="6" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Amount Rs.</p>';
                                echo '<div class="input-control text" style="margin: 0;">';
                                echo '<input type="text" id="basicamount" class="amt onchangeupdate_grand" maxlength="10" name="amount" value="0" readonly="readonly" tabindex="7" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Extra persons</p>';
                                echo '<div class="input-control text">';
                                echo '<input type="number" id="extrapax" name="extrapax" class="onchangeupdate_extra" value="0" tabindex="8" min="0" max="200" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-g mygrid">';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Extra Rate Rs.</p>';
                                echo '<div class="input-control text" style="margin: 0;">';
                                echo '<input type="text" id="extrarate" class="amt onchangeupdate_extra" maxlength="10" name="extrarate" value="0" tabindex="9" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Extra Amount Rs.</p>';
                                echo '<div class="input-control text" style="margin: 0;">';
                                echo '<input type="text" id="extraamount" class="amt onchangeupdate_grand" maxlength="10" name="extraamount" value="0" readonly="readonly" tabindex="10" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>No. of children</p>';
                                echo '<div class="input-control text">';
                                echo '<input type="number" id="children" name="children" class="onchangeupdate_child" value="0" tabindex="11" min="0" max="200" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Child Rate Rs.</p>';
                                echo '<div class="input-control text" style="margin: 0;">';
                                echo '<input type="text" id="childrate" class="amt onchangeupdate_child" maxlength="10" name="childrate" value="0" tabindex="12" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-g mygrid" style="margin-bottom: 30px;">';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Child Amount Rs.</p>';
                                echo '<div class="input-control text" style="margin: 0;">';
                                echo '<input type="text" id="childamount" class="amt onchangeupdate_grand" maxlength="10" name="childamount" value="0" readonly="readonly" tabindex="13" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>Grand Total Rs.</p>';
                                echo '<div class="input-control text" style="margin: 0;">';
                                echo '<input type="text" id="grandtotal" class="amt" maxlength="10" name="grandtotal" value="0" readonly="readonly" tabindex="14" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" />';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="pure-u-1-4"></div>';
                                echo '<div class="pure-u-1-4">';
                                echo '<p>&nbsp;</p>';
                                echo '<input type="hidden" name="hid" value="' . $row['hid'] . '" />';
                                echo '<input type="hidden" name="eid" value="' . $KEY . '" />';
                                echo '<input type="submit" name="submit" value="Add room" tabindex="15" style="float:right;margin: 0;width: 100%;height: 34px;" />';
                                echo '</div>';
                                echo '</form>';
                                echo '</div>';
                            }
                            mysql_free_result($result);
                        }
                        ?>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    $("input:text").focus(function() { $(this).select(); } );
</script>
<?php include 'footer.html'; ?>