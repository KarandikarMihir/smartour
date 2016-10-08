<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=customer.php">';
    die();
}
if ($_POST)
{
    dbConnect();
    $Name = SafeString($_POST['name']);
    $Address = SafeString($_POST['address']);
    $Landline = SafeString($_POST['landline']);
    $Mobile = SafeString($_POST['mobile']);
    $Email = SafeString($_POST['email']);
    mysql_query("UPDATE customer SET name='$Name', address='$Address', landline='$Landline', mobile='$Mobile', email='$Email' WHERE srno=$KEY") or die(mysql_error());
    //header('Location: enquiry.php');
    echo '<meta http-equiv="refresh" content="0; url=customer.php">';
    die();
}
else{
    dbConnect();
    $result = mysql_query("SELECT name, address, landline, mobile, email FROM customer WHERE srno=$KEY") or die(mysql_error());
    if(!mysql_num_rows($result) || mysql_error()){
        echo '<meta http-equiv="refresh" content="0; url=customer.php">';
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
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Update Customer</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="customer_update_form.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
        <div style="float:left;width:250px">
            <p>Name <span class="errortext" id="nameerror"></span></p>
            <div class="input-control text"><input type="text" class="validate-name" name="name" value="<?php if(isset($Name)) echo $Name; ?>" autofocus maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Address</p>
            <div class="input-control text"><input type="text" class="validate-address" name="address" value="<?php if(isset($Address)) echo $Address; ?>" maxlength="300" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Landline</p>
            <div class="input-control text"><input type="phone" class="skippable" name="landline" value="<?php if(isset($Landline)) echo $Landline; ?>" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Mobile</p>
            <div class="input-control text"><input type="phone" class="skippable" name="mobile" value="<?php if(isset($Mobile)) echo $Mobile; ?>" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        </div>
        <div id="separator2" style="float:left;width:2%">&nbsp;</div>
        <div style="float:left;width:260px">
            <p>Email</p>
            <div class="input-control text"><input type="email" class="skippable validate-email" name="email" value="<?php if(isset($Email)) echo $Email; ?>" style="width:250px;" maxlength="100" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" name="submit" value="Update" /></p>
    </form>
</div>
</div>
</div>
<?php include 'footer.html'; ?>
