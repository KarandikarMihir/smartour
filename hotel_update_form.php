<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=hotel_update.php">';
    die();
}
if ($_POST)
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
    mysql_query("UPDATE hotellist SET name='$Name', name_on_transaction='$NameOnTransaction', account_details='$AccountDetails', cperson_site='$CPersonSite', cperson_office='$CPersonOffice', address_site='$AddressSite', address_office='$AddressOffice', cityid=$City, pincode='$Pincode', landline_site='$LandlineSite', landline_office='$LandlineOffice', mobile_site='$MobileSite', mobile_office='$MobileOffice', email_site='$EmailSite', email_office='$EmailOffice', chkin_time='$ChkInTime', chkout_time='$ChkOutTime', commission='$Commission', website='$Website' WHERE srno=$KEY") or die(mysql_error());
    //header('location: hotel.php');
    echo '<meta http-equiv="refresh" content="0; url=hotel.php">';
}
else
{
    dbConnect();
    $result = mysql_query("SELECT * FROM hotellist WHERE srno = " . $KEY);
    if(!mysql_num_rows($result) || mysql_error()){
        echo '<meta http-equiv="refresh" content="0; url=hotel_update.php">';
        die();
    }
    
        $row = mysql_fetch_array($result);
        $Name = $row['name'];
        $NameOnTransaction = $row['name_on_transaction'];
        $AccountDetails = $row['account_details'];
        $CPersonSite = $row['cperson_site'];
        $CPersonOffice = $row['cperson_office'];
        $AddressSite = $row['address_site'];
        $AddressOffice = $row['address_office'];
        $City = $row['cityid'];
        $Pincode = $row['pincode'];
        $LandlineSite = $row['landline_site'];
        $LandlineOffice = $row['landline_office'];
        $MobileSite = $row['mobile_site'];
        $MobileOffice = $row['mobile_office'];
        $EmailSite = $row['email_site'];
        $EmailOffice = $row['email_office'];
        $ChkInTime = $row['chkin_time'];
        $ChkOutTime = $row['chkout_time'];
        $Commission = $row['commission'];
        $Website = $row['website'];
        mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Update Hotel</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div id="binder" style="width:100%;height:380px;overflow:auto;">
        <form method="post" action="hotel_update_form.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
            <div style="float:left;width:250px">
                <p>Name</p>
                <div class="input-control text"><input type="text" class="validate-name" name="name" value="<?php if(isset($Name)) echo $Name;?>" maxlength="50" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>City (Hotel)</p>
                <div class="input-control select">
                <select style="width: 100%;" name="city" id="city">
                <?php
                    dbConnect();
                    $result = mysql_query("SELECT * FROM citylist ORDER BY name ASC") or die(mysql_error());
                    while($row = mysql_fetch_array($result)){
                        if($row['srno'] == $City){
                            echo '<option value="'. $row['srno'] .'" selected="selected">' . $row['name'] . '</option>';
                        }
                        else{
                            echo '<option value="'. $row['srno'] .'">' . $row['name'] . '</option>';
                        }
                    }
                    mysql_free_result($result);
                ?>
                </select>
            </div>
                <p>Pincode (Hotel)</p>
                <div class="input-control text"><input type="text" class="skippable" name="pincode" value="<?php if(isset($Pincode)) echo $Pincode;?>" maxlength="10" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                
                <p>Name (On Cheque)</p>
                <div class="input-control text"><input type="text" class="validate-name" name="name_on_transaction" value="<?php if(isset($NameOnTransaction)) echo $NameOnTransaction;?>" maxlength="50" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                
                <p>Account Details</p>
                <div class="input-control text"><input type="text" class="skippable" name="account_details" value="<?php if(isset($AccountDetails)) echo $AccountDetails;?>" maxlength="50" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                
                
            </div>
            <div id="separator" style="float:left;width:2%">&nbsp;</div>
            <div style="float:left;width:250px">
                <p>Contact Person (Hotel)</p>
                <div class="input-control text"><input type="text" class="validate-name" name="cperson_site" value="<?php if(isset($CPersonSite)) echo $CPersonSite;?>" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Address (Hotel)</p>
                <div class="input-control text"><input type="text" class="validate-address" name="address_site" value="<?php if(isset($AddressSite)) echo $AddressSite;?>" maxlength="300" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>	                
                <p>Landline (Hotel)</p>
                <div class="input-control text"><input type="phone" class="skippable" name="landline_site" value="<?php if(isset($LandlineSite)) echo $LandlineSite;?>" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Mobile (Hotel)</p>
                <div class="input-control text"><input type="phone" class="skippable" name="mobile_site" value="<?php if(isset($MobileSite)) echo $MobileSite;?>" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Email (Hotel)</p>
                <div class="input-control text"><input type="email" class="skippable" name="email_site" value="<?php if(isset($EmailSite)) echo $EmailSite;?>" maxlength="100" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            </div>
            <div id="separator2" style="float:left;width:2%">&nbsp;</div>
            <div style="float:left;width:260px">
                <p>Contact Person (Office)</p>
                <div class="input-control text"><input type="text" class="validate-name skippable" name="cperson_office" value="<?php if(isset($CPersonOffice)) echo $CPersonOffice;?>" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Address (Office)</p>
                <div class="input-control text"><input type="text" class="validate-address skippable" name="address_office" value="<?php if(isset($AddressOffice)) echo $AddressOffice;?>" maxlength="300" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>	                
                <p>Landline (Office)</p>
                <div class="input-control text"><input type="phone" class="skippable" name="landline_office" value="<?php if(isset($LandlineOffice)) echo $LandlineOffice;?>" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Mobile (Office)</p>
                <div class="input-control text"><input type="phone" class="skippable" name="mobile_office" value="<?php if(isset($MobileOffice)) echo $MobileOffice;?>" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                <p>Email (Office)</p>
                <div class="input-control text"><input type="email" class="skippable" name="email_office" value="<?php if(isset($EmailOffice)) echo $EmailOffice;?>" maxlength="100" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                
            </div>
            <div id="separator2" style="float:left;width:2%">&nbsp;</div>
            <div style="float:left;width:260px">            
                <p>Check In</p>
                <div class="input-control text"><input type="text" class="time" placeholder="HH:MM" name="chkin_time" value="<?php if(isset($ChkInTime)) echo $ChkInTime;?>" maxlength="5"  spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:100%;" /></div>
                <p>Check Out</p>
                <div class="input-control text"><input type="text" class="time" placeholder="HH:MM" name="chkout_time" value="<?php if(isset($ChkOutTime)) echo $ChkOutTime;?>" maxlength="5"  spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:100%;" /></div>
                <p>Commission (%)</p>
                <div class="input-control text"><input type="text" class="amt skippable" placeholder="00.00" name="commission" value="<?php if(isset($Commission)) echo $Commission;?>" maxlength="5" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:250px;" /></div>
                <p>Website</p>
                <div class="input-control text"><input type="url" class="skippable" name="website" maxlength="100" placeholder="http://www.something.com" value="<?php if(isset($Website)) echo $Website;?>"  spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" style="width:250px;" /></div>
                <p>&nbsp;</p>
                <p style="text-align:right;"><input type="submit" name="submit" value="Save"/></p>
            </div>
        </form>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>