<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=enquiry.php">';
    die();
}
if ($_POST)
{
    dbConnect(); 
    $Destination = SafeString($_POST['destination']); 
    $EnqFor = SafeString($_POST['EnqFor']);
    $EnqMode = SafeString($_POST['EnqMode']);
    $PaxNos = intval(SafeString($_POST['paxnos']));
    $FromDate = SafeString($_POST['FromDate']);
    $ToDate = SafeString($_POST['ToDate']);
    $username = decrypt($_COOKIE['SmarTourID'], $Salt);
    $uid = namei($username);
    mysql_query("INSERT INTO enquiry(destination, enqfor, enqmode, paxnos, fromdate, todate, cid, uid) VALUES('" . $Destination . "','" . $EnqFor . "','" . $EnqMode . "'," . $PaxNos . ",'" . $FromDate . "','" . $ToDate . "', " . $KEY . "," . $uid . ")") or die(mysql_error());
    //header('Location: enquiry.php');
    echo '<meta http-equiv="refresh" content="0; url=enquiry.php">';
    die();
}
else{
    dbConnect();
    $result=mysql_query("SELECT * FROM customer WHERE srno=$KEY") or die(mysql_error());
    if(!mysql_num_rows($result)){
        echo '<meta http-equiv="refresh" content="0; url=enquiry.php">';
        die();
    }
    while($row = mysql_fetch_array($result))
    {
        $Name = $row['name'];
        $Address = $row['address'];
        $Landline = $row['landline'];
        $Mobile = $row['mobile'];
        $Email = $row['email'];
    }
    mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">New Enquiry</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="enquiry_new.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
    <div style="float:left;width:250px">
        <p>Destination</p>
        <div class="input-control text"><input type="text" class="validate-name" list="citylist" placeholder="Press &darr; to expand" autofocus tabindex="1" name="destination" maxlength="25" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/>
            <datalist id="citylist" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;">
                <?php
                dbConnect();
                $result=mysql_query("SELECT name FROM citylist ORDER BY name") or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="' . $row['name'] . '">';
                }
                mysql_free_result($result);
                ?>
            </datalist>
        </div>
        <p>Number of persons</p>
        <div class="input-control text"><input type="number" name="paxnos" tabindex="2" style="width:250px;" min="1" max="200" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>From (MM-DD-YYYY)</p>
        <div class="input-control text"><input type="date" name="FromDate" tabindex="3" min="<?php echo date("Y-m-d"); ?>" onChange="setToDate(this.value,'ToDate');" maxlength="10" placeholder="yyyy-mm-dd" style="width:250px;height:32px;"   spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
        <p>To (MM-DD-YYYY)</p>
        <div class="input-control text"><input type="date" name="ToDate" tabindex="4" min="<?php echo date("Y-m-d", time()+86400); ?>" maxlength="10" placeholder="yyyy-mm-dd" style="width:250px;height:32px;" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>       
    </div>
        <div id="separator" style="float:left;width:2%">&nbsp;</div>
        <div style="float:left;width:250px">
            <p>Name <span class="errortext" id="nameerror"></span></p>
            <div class="input-control text"><input type="text" name="name" class="ignore" value="<?php if(isset($Name)) echo $Name; ?>" disabled="disabled" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Address</p>
            <div class="input-control text"><input type="text" name="address" class="ignore" value="<?php if(isset($Address)) echo $Address; ?>" disabled="disabled" maxlength="300" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Landline</p>
            <div class="input-control text"><input type="phone" name="landline" class="ignore" value="<?php if(isset($Landline)) echo $Landline; ?>" disabled="disabled" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Mobile</p>
            <div class="input-control text"><input type="phone" name="mobile" class="ignore" value="<?php if(isset($Mobile)) echo $Mobile; ?>" disabled="disabled" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        </div>
        <div id="separator2" style="float:left;width:2%">&nbsp;</div>
        <div style="float:left;width:250px">
            <p>Email</p>
            <div class="input-control text"><input type="email" name="email" class="ignore" value="<?php if(isset($Email)) echo $Email; ?>" disabled="disabled" style="width:250px;" maxlength="100" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Enquiry For</p>
            <div class="input-control select">
                <select name="EnqFor" tabindex="5">
                    <option>Hotel Booking</option>
                    <option>Tour Booking</option>
                    <option>Bus Booking</option>
                    <option>Other</option>
                </select>
            </div>
            <p>Enquiry Mode</p>
            <div class="input-control select">
                <select name="EnqMode" tabindex="6">
                    <option>Email/SMS</option>
                    <option>Advertisement</option>
                    <option>Reference</option>
                    <option>Facebook</option>
                    <option>Just Dial</option>
                    <option>Other</option>
                </select>
            </div>            
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" name="submit" value="Update" tabindex="7" /></p>
        </div>
    </form>
</div>
</div>
</div>
<?php include 'footer.html'; ?>
