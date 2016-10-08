<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=enquiry.php">';
    die();
}
if($_POST)
{
    dbConnect(); 
    $Destination = SafeString($_POST['destination']);
    $EnqFor = SafeString($_POST['EnqFor']);
    $EnqMode = SafeString($_POST['EnqMode']);
    $PaxNos = intval(SafeString($_POST['paxnos']));
    $FromDate = SafeString($_POST['FromDate']);
    $ToDate = SafeString($_POST['ToDate']); 
    mysql_query("UPDATE enquiry SET destination='$Destination', enqfor='$EnqFor', enqmode='$EnqMode', paxnos=$PaxNos, fromdate='$FromDate', todate='$ToDate' WHERE srno=$KEY") or die(mysql_error());
    
    //header('location: enquiry.php');
    echo '<meta http-equiv="refresh" content="0; url=enquiry.php">';
    die();
}
else
{
    dbConnect();
    $result = mysql_query("SELECT * FROM enquiry, customer WHERE enquiry.cid=customer.srno AND enquiry.srno = " . $KEY) or die(mysql_error());
    if(!mysql_num_rows($result) || mysql_error()){
        echo '<meta http-equiv="refresh" content="0; url=enquiry.php">';
        die();
    }

    while($row = mysql_fetch_array($result))
    {
        $Destination = $row['destination']; 
        $EnqDate = date('Y-m-d', strtotime($row['timestamp']));
        $EnqFor = $row['enqfor'];
        $EnqMode = $row['enqmode'];
        $Name = $row['name'];
        $Address = $row['address'];
        $Landline = $row['landline'];
        $Mobile = $row['mobile'];
        $Email = $row['email'];
        $PaxNos = intval($row['paxnos']);
        $FromDate = $row['fromdate'];
        $ToDate = $row['todate'];
    }
    mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Update Enquiry</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="enquiry_update_form.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
    <div style="float:left;width:250px">
        <p>Destination</p>
        <div class="input-control text"><input type="text" class="validate-name" list="citylist" value="<?php echo $Destination; ?>" placeholder="Press &darr; to expand" autofocus name="destination" maxlength="30" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/>
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
        <div class="input-control text"><input type="number" value="<?php echo $PaxNos; ?>" min="1" max="200" style="width:250px;" name="paxnos" min="1" max="200" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>From (MM-DD-YYYY)</p>
        <div class="input-control text"><input type="date" value="<?php echo $FromDate; ?>" style="width:250px;height:32px;" onChange="setToDate(this.value,'ToDate');" maxlength="10" name="FromDate" placeholder="yyyy-mm-dd" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
        <p>To (MM-DD-YYYY)</p>
        <div class="input-control text"><input type="date" value="<?php echo $ToDate; ?>" style="width:250px;height:32px;" min="<?php echo $FromDate; ?>" maxlength="10" name="ToDate" placeholder="yyyy-mm-dd" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>        
    </div>
    <div id="separator" style="float:left;width:2%">&nbsp;</div>
    <div style="float:left;width:250px">
        <p>Name <span class="errortext" id="nameerror"></span></p>
        <div class="input-control text"><input type="text" class="ignore" value="<?php echo $Name; ?>" name="name" disabled="disabled" maxlength="50" disabled="disabled" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>Address <span class="errortext" id="addresserror"></span></p>
        <div class="input-control text"><input type="text" class="ignore" value="<?php echo $Address; ?>" name="address" disabled="disabled" maxlength="300"spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>Landline <span class="errortext" id="landlineerror"></span></p>
        <div class="input-control text"><input type="phone" class="ignore" value="<?php echo $Landline; ?>" name="landline" disabled="disabled" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>Mobile <span class="errortext" id="mobileerror"></span></p>
        <div class="input-control text"><input type="phone" class="ignore" value="<?php echo $Mobile; ?>" name="mobile" disabled="disabled" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
    </div>
    <div id="separator2" style="float:left;width:2%">&nbsp;</div>
    <div style="float:left;width:250px">
        <p>Email</p>
        <div class="input-control text"><input type="email" class="ignore" value="<?php echo $Email; ?>" maxlength="100" style="width:250px;" name="email" disabled="disabled" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>Enquiry For</p>
        <div class="input-control select">
            <select name="EnqFor">
                <?php
                if($EnqFor=="Hotel Booking")
                    echo '<option selected>Hotel Booking</option>';
                else
                    echo '<option>Hotel Booking</option>';
                if($EnqFor=="Tour Booking")
                    echo '<option selected>Tour Booking</option>';
                else
                    echo '<option>Tour Booking</option>';
                if($EnqFor=="Bus Booking")
                    echo '<option selected>Bus Booking</option>';
                else
                    echo '<option>Bus Booking</option>';
                if($EnqFor=="Other")
                    echo '<option selected>Hotel Booking</option>';
                else
                    echo '<option>Other</option>';
                ?>
            </select>
        </div>
        <p>Enquiry Mode</p>
        <div class="input-control select">
            <select name="EnqMode">
                <?php
                if($EnqMode=="Email/SMS")
                    echo '<option selected>Email/SMS</option>';
                else
                    echo '<option>Email/SMS</option>';      
                
                if($EnqMode=="Advertisement")
                    echo '<option selected>Advertisement</option>';
                else
                    echo '<option>Advertisement</option>';
                
                if($EnqMode=="Reference")
                    echo '<option selected>Reference</option>';
                else
                    echo '<option>Reference</option>';  
                
                if($EnqMode=="Facebook")
                    echo '<option selected>Facebook</option>';
                else
                    echo '<option>Facebook</option>';
                
                if($EnqMode=="Just Dial")
                    echo '<option selected>Just Dial</option>';
                else
                    echo '<option>Just Dial</option>';
                
                if($EnqMode=="Other")
                    echo '<option selected>Other</option>';
                else
                    echo '<option>Other</option>';
                ?>
            </select>
        </div>        
        <p>&nbsp;</p>
        <p style="text-align:right;"><input type="submit" name="submit" value="Update" /></p>
    </div>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>
