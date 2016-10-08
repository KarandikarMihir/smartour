<?php include 'header.php'; ?>
<?php
if($_POST)
{
    dbConnect();
    $Name = SafeString($_POST['name']);
    $NameOnTransaction = SafeString($_POST['name_on_transaction']);
    $AccountDetails = SafeString($_POST['account_details']);
    $CPersonSite = SafeString($_POST['cperson_site']);
    $CPersonOffice = SafeString($_POST['cperson_office']);
    $AddressSite = SafeString($_POST['address_site']);
    $AddressOffice = SafeString($_POST['address_office']);
    $City = SafeString($_POST['city']);
    $Pincode = SafeString($_POST['pincode']);
    $LandlineSite = SafeString($_POST['landline_site']);
    $LandlineOffice = SafeString($_POST['landline_office']);
    $MobileSite = SafeString($_POST['mobile_site']);
    $MobileOffice = SafeString($_POST['mobile_office']);
    $EmailSite = SafeString($_POST['email_site']);
    $EmailOffice = SafeString($_POST['email_office']);
    $ChkInTime = SafeString($_POST['chkin_time']);
    $ChkOutTime = SafeString($_POST['chkout_time']);
    $Commission = SafeString($_POST['commission']);
    $Website = SafeString($_POST['website']);    
    $username = decrypt($_COOKIE['SmarTourID'], $Salt);
    $uid = namei($username);
    mysql_query("INSERT INTO hotellist (name,name_on_transaction,account_details,cperson_site,cperson_office,address_site,address_office,cityid,pincode,landline_site,landline_office,mobile_site,mobile_office,email_site,email_office,chkin_time,chkout_time,commission,website,uid) VALUES('" . $Name . "', '" . $NameOnTransaction . "','" . $AccountDetails . "','" . $CPersonSite . "','" . $CPersonOffice . "', '" . $AddressSite . "','" . $AddressOffice . "'," . $City . ", '" . $Pincode . "', '" . $LandlineSite . "','" . $LandlineOffice . "','" . $MobileSite . "','" . $MobileOffice . "','" . $EmailSite . "','" . $EmailOffice . "','" . $ChkInTime . "','" . $ChkOutTime . "','" . $Commission . "','" . $Website . "'," . $uid . ")") or die(mysql_error());
    $MaxID = mysql_query("SELECT MAX(srno) FROM hotellist") or die(mysql_error());
    $MaxID = mysql_fetch_array($MaxID, MYSQL_BOTH) or die(mysql_error());
    $MaxID = intval($MaxID[0]);
    mkdir("hoteldata/$MaxID", 0700, true);
    chmod("hoteldata/$MaxID", 0777);
    //header('location: hotel_add_rooms.php?KEY=' . $MaxID);
    echo '<meta http-equiv="refresh" content="0; url=hotel_add_rooms.php?KEY=' . $MaxID . '">';
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">New Hotel</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div id="binder" style="width:100%;height:380px;overflow:auto;">
        <form method="post" action="hotel_new.php" novalidate="novalidate">
            <div style="float:left;width:250px">
                <p>Name</p>
                <div class="input-control text"><input type="text" class="validate-name" name="name" maxlength="50" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>City (Hotel)</p>
                <div class="input-control select">
                <select style="width: 100%;" name="city" id="city">
                <?php
                    dbConnect();
                    $result = mysql_query("SELECT srno, name FROM citylist ORDER BY name ASC") or die(mysql_error());
                    while($row = mysql_fetch_array($result)){
                        echo '<option value="'. $row['srno'] .'">' . $row['name'] . '</option>';
                    }
                    mysql_free_result($result);
                ?>
                </select>
                </div>
                <p>Pincode (Hotel)</p>
                <div class="input-control text"><input type="text" class="skippable" name="pincode" maxlength="10" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                
                <p>Name (On Cheque)</p>
                <div class="input-control text"><input type="text" class="validate-name" name="name_on_transaction" maxlength="50" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                
                <p>Account Details</p>
                <div class="input-control text"><input type="text" class="skippable" name="account_details" maxlength="50" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                
                
            </div>
            <div id="separator" style="float:left;width:2%">&nbsp;</div>
            <div style="float:left;width:250px">
                <p>Contact Person (Hotel)</p>
                <div class="input-control text"><input type="text" class="validate-name" name="cperson_site" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Address (Hotel)</p>
                <div class="input-control text"><input type="text"  class="validate-address" name="address_site" maxlength="300" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>	                
                <p>Landline (Hotel)</p>
                <div class="input-control text"><input type="phone" class="skippable" name="landline_site" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Mobile (Hotel)</p>
                <div class="input-control text"><input type="phone" class="skippable" name="mobile_site" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Email (Hotel)</p>
                <div class="input-control text"><input type="email" class="skippable" name="email_site" maxlength="100" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            </div>
            <div id="separator2" style="float:left;width:2%">&nbsp;</div>
            <div style="float:left;width:260px">
                <p>Contact Person (Office)</p>
                <div class="input-control text"><input type="text" class="validate-name skippable" name="cperson_office" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Address (Office)</p>
                <div class="input-control text"><input type="text" class="validate-address skippable" name="address_office" maxlength="300" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>	                
                <p>Landline (Office)</p>
                <div class="input-control text"><input type="phone" class="skippable" name="landline_office" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Mobile (Office)</p>
                <div class="input-control text"><input type="phone" class="skippable" name="mobile_office" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Email (Office)</p>
                <div class="input-control text"><input type="email" class="skippable validate-email" name="email_office" maxlength="100" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                
            </div>
            <div id="separator2" style="float:left;width:2%">&nbsp;</div>
            <div style="float:left;width:260px">            
                <p>Check In</p>
                <div class="input-control text"><input type="text" class="time" placeholder="HH:MM" name="chkin_time" maxlength="5"  spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:100%;" /></div>
                <p>Check Out</p>
                <div class="input-control text"><input type="text" class="time" placeholder="HH:MM" name="chkout_time" maxlength="5"  spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:100%;" /></div>
                <p>Commission (%)</p>
                <div class="input-control text"><input type="text" class="amt skippable" placeholder="00.00" name="commission" maxlength="5" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:250px;" /></div>
                <p>Website</p>
                <div class="input-control text"><input type="url" name="website" class="skippable" maxlength="100" placeholder="http://www.something.com"  spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:250px;" /></div>
                <p>&nbsp;</p>
                <p style="text-align:right;"><input type="submit" name="submit" value="Save"/></p>
            </div>
        </form>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>