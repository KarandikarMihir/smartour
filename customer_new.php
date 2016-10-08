<?php include 'header.php'; ?>
<?php
if ($_POST)
{
    dbConnect();
    $Name = SafeString($_POST['name']);
    $Address = SafeString($_POST['address']);
    $Landline = SafeString($_POST['landline']);
    $Mobile = SafeString($_POST['mobile']);
    $Email = SafeString($_POST['email']);
    $username=decrypt($_COOKIE['SmarTourID'], $Salt);
    $uid = namei($username);
    mysql_query("INSERT INTO customer(name, address, landline, mobile, email, uid) VALUES('" . $Name . "','" . $Address . "','" . $Landline . "','" . $Mobile . "','" . $Email . "','" . $uid . "')") or die(mysql_error());
   //header('Location: enquiry.php');
    if(isset($_REQUEST['mode'])){
        $result = mysql_query("SELECT srno FROM customer WHERE uid=$uid ORDER BY srno DESC LIMIT 1") or die(mysql_error());
        $row=  mysql_fetch_array($result);
        $KEY=$row['srno'];
        if($_REQUEST['mode']=="tour"){
            echo '<meta http-equiv="refresh" content="0; url=tour_booking_new.php?KEY=' . $KEY . '">';
        }
        if($_REQUEST['mode']=="enquiry"){
            echo '<meta http-equiv="refresh" content="0; url=enquiry_new.php?KEY=' . $KEY . '">';
        }        
        die();
    }
    echo '<meta http-equiv="refresh" content="0; url=customer.php">';
    die();
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">New Customer</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="customer_new.php<?php if(isset($_REQUEST['mode'])) { echo '?mode=' . $_REQUEST['mode'];} ?>">
        <div style="float:left;width:250px">
            <p>Name <span class="errortext" id="nameerror"></span></p>
            <div class="input-control text"><input type="text" class="validate-name" name="name"  autofocus maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Address</p>
            <div class="input-control text"><input type="text" class="validate-address" name="address"  maxlength="300" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Landline</p>
            <div class="input-control text"><input type="phone" name="landline" class="skippable" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Mobile</p>
            <div class="input-control text"><input type="phone" name="mobile" class="skippable" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        </div>
        <div id="separator2" style="float:left;width:2%">&nbsp;</div>
        <div style="float:left;width:260px">
            <p>Email</p>
            <div class="input-control text"><input type="email" class="validate-email skippable" name="email" style="width:250px;" maxlength="100" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" name="submit" value="Save" /></p>
    </form>
</div>
</div>
</div>
<?php include 'footer.html'; ?>
