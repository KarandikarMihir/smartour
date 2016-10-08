<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=application.php">';
    die();
}
if ($_POST)
{
    dbConnect();
    $BasicAmount = $_POST['basic_amount'];
    $Scharge = $_POST['scharge'];
    $Stax = $_POST['stax'];
    $Ltax = $_POST['ltax'];
    $Gtotal = $_POST['gtotal'];
    $checkresult = mysql_query("SELECT * FROM application_amount WHERE aid=$KEY") or die(mysql_error());
    if(mysql_num_rows($checkresult)){
        mysql_query("UPDATE application_amount set basic_amount=$BasicAmount, scharge=$Scharge, stax=$Stax, ltax=$Ltax, balance_amount=$Gtotal WHERE aid=$KEY") or die(mysql_error());
    }
    else{
        mysql_query("INSERT into application_amount (basic_amount,scharge,stax,ltax,balance_amount,aid) values($BasicAmount,$Scharge,$Stax,$Ltax,$Gtotal,$KEY) ") or die(mysql_error());        
    }
    //header('Location: enquiry.php');
    echo '<meta http-equiv="refresh" content="0; url=application.php">';
    die();    
}
else{
    dbConnect();
    $result = mysql_query("SELECT sum(application_rooms.total) as sum, params.scharge, application_amount.* FROM application_rooms, params, application_amount WHERE application_rooms.aid = $KEY and application_amount.aid = $KEY") or die(mysql_error());
//    if(!mysql_num_rows($result)){
//        echo '<meta http-equiv="refresh" content="0; url=application.php">';
//        die();
//    }
    while($row = mysql_fetch_array($result))
    {
        $Sum = $row['sum'];
        $SCharge = $row['scharge'];
        $Stax = $row['stax'];
        $Ltax = $row['ltax'];
    }
    mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Amount Details</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="application_amount.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
        <div style="float:left;width:250px">
            <p>Basic amount <span class="errortext" id="nameerror"></span></p>
            <div class="input-control text"><input type="text" id="basic_amount" class="amt" onchange="calculateGrandTotal();" name="basic_amount" value="<?php echo $Sum; ?>" autofocus maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Service charge</p>
            <div class="input-control text"><input type="text" id="scharge" class="amt" onchange="calculateGrandTotal();" name="scharge" value="<?php echo $SCharge; ?>" maxlength="300" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Service Tax</p>
            <div class="input-control text"><input type="text" id="stax" class="amt" onchange="calculateGrandTotal();" name="stax" value="<?php if(isset($Stax)){ echo $Stax;} else { echo '0';} ?>" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Luxury Tax</p>
            <div class="input-control text"><input type="text" id="ltax" class="amt skippable" onchange="calculateGrandTotal();" name="ltax" value="<?php if(isset($Ltax)){ echo $Ltax;} else { echo '0';} ?>" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        </div>
        <div id="separator2" style="float:left;width:2%">&nbsp;</div>
        <div style="float:left;width:260px">
            <p>Grand total</p>
            <div class="input-control text"><input type="text" class="amt" readonly id="gtotal" name="gtotal" value="<?php echo $Sum + $SCharge; ?>" style="width:250px;" maxlength="100" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" name="submit" value="Update" /></p>
    </form>
</div>
</div>
</div>
<?php include 'footer.html'; ?>
