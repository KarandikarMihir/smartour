<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=application_update.php">';
    die();
}

if ($_POST)
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
    mysql_query("UPDATE application SET paxnos=$PaxNos, chkin='$ChkIn', chkout='$ChkOut', nights=$NightsNos, confirmedwith='$ConfirmedWith', hid=$Hotel WHERE srno=$KEY") or die(mysql_error());
    
    //header('location: application.php');
    echo '<meta http-equiv="refresh" content="0; url=application.php">';
}
else
{
    $KEY = $_REQUEST['KEY'];
    dbConnect();
    dbConnect();
    $result = mysql_query("SELECT customer.*, application.* FROM application, enquiry, customer WHERE application.srno = $KEY AND application.eid = enquiry.srno AND enquiry.cid=customer.srno") or die(mysql_error());
    if(!mysql_num_rows($result)){
        echo '<meta http-equiv="refresh" content="0; url=application.php">';
        die();
    }    
    while($row = mysql_fetch_array($result))
    {
        $Name = $row['name'];
        $Address = $row['address'];
        $Landline = $row['landline'];
        $Mobile = $row['mobile'];
        $PaxNos = $row['paxnos'];
        $FromDate = $row['chkin'];
        $ToDate = $row['chkout'];
        $ConfirmedWith = $row['confirmedwith'];
        $checkin=intval(substr($row['chkin'], -2));
        $checkout=intval(substr($row['chkout'], -2));
        $difference=$checkout-$checkin;
        $Hid = $row['hid'];
    }
    mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Update Application</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div id="binder" style="width:100%;height:370px;overflow:auto;">
        <p style="padding: 10px;margin-bottom: 25px;background: #ebebff;border: solid 1px #0000ff;width: 95%;"><span class="label info">Note</span><a href="application_rooms.php?KEY=<?php echo $KEY; ?>" style="margin-left: 20px;">Redirect to Room Details</a><i class="icon-new-tab"></i><a href="application_amount.php?KEY=<?php echo $KEY; ?>" style="margin-left: 20px;">Redirect to Amount Details</a> <i class="icon-new-tab"></i></p>
        <form method="post" action="application_update_form.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
        <div style="float:left;width:250px">
            <p>Name</p>
            <div class="input-control text"><input type="text" name="name" class="ignore" maxlength="50" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" value="<?php echo $Name; ?>" /></div>
            <p>Address</p>
            <div class="input-control text"><input type="text" name="address" class="ignore" maxlength="300" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" value="<?php echo $Address; ?>" /></div>	
            <p>Landline</p>
            <div class="input-control text"><input type="phone" name="landline" class="ignore" maxlength="15" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" value="<?php echo $Landline; ?>" /></div>
            <p>Mobile</p>
            <div class="input-control text"><input type="phone" name="mobile" class="ignore" maxlength="15" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" value="<?php echo $Mobile; ?>" /></div>
        </div>
        <div id="separator" style="float:left;width:40px">&nbsp;</div>
        <div style="float:left;width:250px">
            <p>Hotel Name</p>
            <div class="input-control select">
                <select name="hotel" style="padding: 4px;" tabindex="1" autofocus onChange="loadResults('roomtypes','fetchRoomTypes','request.php', this.value);" value="<?php echo $HotelName; ?>">
                    <?php
                        dbConnect();
                        $result=mysql_query("SELECT srno, name FROM hotellist ORDER BY srno ASC") or die(mysql_error());
                        while($row = mysql_fetch_array($result))
                        {
                            if($row['srno']==$Hid){
                                echo '<option value="' . $row['srno'] . '" selected="selected">' . $row['name'] . '</option>';
                            }
                            else{
                                echo '<option value="' . $row['srno'] . '">' . $row['name'] . '</option>';
                            }
                        }
                        
                        mysql_free_result($result);
                    ?>
                </select>
            </div>            
            <p>Number of persons</p>
            <div class="input-control text"><input type="number" tabindex="2" name="paxnos" min="1" max="200" value="<?php echo $PaxNos; ?>"  spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Check In</p>
            <div class="input-control text"><input type="date" tabindex="3" name="chkin" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $FromDate; ?>" onChange="setToDate(this.value,'chkout');" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:250px;height:32px;" maxlength="10" /></div>
            <p>Check Out</p>
            <div class="input-control text"><input type="date" tabindex="4" name="chkout" min="<?php echo date("Y-m-d", time()+86400); ?>" value="<?php echo $ToDate; ?>"  spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:250px;height:32px;" maxlength="10" /></div>            
        </div>
        <div id="separator2" style="float:left;width:40px">&nbsp;</div>
        <div style="float:left;width:250px"> 
            <p>Number of Nights</p>
            <div class="input-control text"><input type="text" tabindex="5" name="nightsnos" value="<?php echo $difference; ?>" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>            
            <p>Confirmed with</p>
            <div class="input-control text"><input type="text" class="validate-name" tabindex="6" value="<?php echo $ConfirmedWith; ?>" name="conwith" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:250px;" /></div>
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" tabindex="7" name="submit" value="Save"/></p>
        </div>
        </form>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>