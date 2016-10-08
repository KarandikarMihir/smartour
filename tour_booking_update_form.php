<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=tour_booking.php">';
    die();
}
if ($_POST)
{
    dbConnect(); 
    $Seats = SafeString($_POST['seats']);
    $Tid = SafeString($_POST['tourname']);
    $username = decrypt($_COOKIE['SmarTourID'], $Salt);
    $uid = namei($username);
    $result = mysql_query("SELECT seats, tid FROM application_tour WHERE srno=$KEY") or die(mysql_error());
    if(mysql_num_rows($result)){
        $row=  mysql_fetch_array($result);
        $old_seats=$row['seats'];$tid=$row['tid'];
        mysql_query("UPDATE tour SET seats_available=seats_available+$old_seats WHERE srno=$tid") or die(mysql_error());
    }
    mysql_query("UPDATE application_tour SET seats=$Seats, tid=$Tid WHERE srno=$KEY") or die(mysql_error());
    mysql_query("UPDATE tour SET seats_available=seats_available-$Seats WHERE srno=$Tid") or die(mysql_error());
    //header('Location: enquiry.php');
    echo '<meta http-equiv="refresh" content="0; url=tour_booking.php">';
    die();
}
else{
    dbConnect();
    $result=mysql_query("SELECT customer.name, customer.address, customer.landline, customer.email, application_tour.seats, application_tour.tid, tour.price, tour.stax FROM customer, application_tour, tour WHERE application_tour.tid=tour.srno AND application_tour.srno=$KEY AND application_tour.cid=customer.srno") or die(mysql_error());
    if(!mysql_num_rows($result)){
        echo '<meta http-equiv="refresh" content="0; url=tour_booking.php">';
        die();
    }
    while($row = mysql_fetch_array($result))
    {
        $Tid = $row['tid'];
        $Seats = $row['seats'];
        $Price = $row['price'];
        $STax = $row['stax'];
        $Amount = ($Seats*$Price)+($Seats*$STax);
        $Name = $row['name'];
        $Address = $row['address'];
        $Landline = $row['landline'];
        $Mobile = $row['mobile'];
        $Email = $row['email'];
    }
    mysql_free_result($result);
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Update Tour Booking</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <form method="post" action="tour_booking_update_form.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
    <div style="float:left;width:250px">
        <p>Tour Name</p>
        <div class="input-control select">
            <select style="width: 100%;" name="tourname" id="tourname" autofocus tabindex="1" onchange="updatePrice();clearSeats();">
            <?php
                dbConnect();
                $result = mysql_query("SELECT srno, name, price, stax, seats_available as s_av FROM tour ORDER BY name ASC") or die(mysql_error());
                while($row = mysql_fetch_array($result)){
                    if($Tid==$row['srno']){
                        echo '<option value="'. $row['srno'] .'" data-rate="' . $row['price'] . '**' . $row['stax'] . '**' . $row['s_av'] . '" selected="selected">' . $row['name'] . '</option>';
                    }
                    else{
                        echo '<option value="'. $row['srno'] .'" data-rate="' . $row['price'] . '**' . $row['stax'] . '**' . $row['s_av'] . '">' . $row['name'] . '</option>';
                    }
                }
                mysql_free_result($result);
            ?>
            </select>
        </div>
        <p>Number of seats <span id="seatsnote" class="fg-color-green"></span></p>
        <div class="input-control text"><input type="number" name="seats" value="<?php echo $Seats; ?>" id="seats" tabindex="2" style="width:250px;" onchange="updateAmount();" onkeyup="updateAmount();" min="1" max="200" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>Price</p>
        <div class="input-control text"><input type="text" name="price" id="price" class="ignore" value="<?php echo $Price;  ?>" onchange="updateAmount();" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <p>Service Tax</p>
        <div class="input-control text"><input type="text" name="stax" id="stax" value="<?php echo $STax; ?>" class="ignore" value="0" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>        
        <p>Total Amount</p>
        <div class="input-control text"><input type="text" name="amount" value="<?php echo $Amount; ?>" id="amount" class="ignore" tabindex="3" value="0" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
        <script type="text/javascript">
            value = ($('#tourname').find(':selected').data('rate')).split('**');
            $('#price').val(value[0]);
            $('#stax').val(value[1]);
            $('#seatsnote').html('<b>('+value[2]+')</b>');
        </script>                
    </div>
        <div id="separator" style="float:left;width:2%">&nbsp;</div>
        <div style="float:left;width:250px">
            <p>Name <span class="errortext" id="nameerror"></span></p>
            <div class="input-control text"><input type="text" name="name" class="ignore" value="<?php if(isset($Name)) echo $Name; ?>" readonly="readonly" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Address</p>
            <div class="input-control text"><input type="text" name="address" class="ignore" value="<?php if(isset($Address)) echo $Address; ?>" readonly="readonly" maxlength="300" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Landline</p>
            <div class="input-control text"><input type="phone" name="landline" class="ignore" value="<?php if(isset($Landline)) echo $Landline; ?>" readonly="readonly" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Mobile</p>
            <div class="input-control text"><input type="phone" name="mobile" class="ignore" value="<?php if(isset($Mobile)) echo $Mobile; ?>" readonly="readonly" maxlength="15" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
            <p>Email</p>
            <div class="input-control text"><input type="email" name="email" class="ignore" value="<?php if(isset($Email)) echo $Email; ?>" readonly="readonly" style="width:250px;" maxlength="100" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>            
        </div>
        <div id="separator2" style="float:left;width:2%">&nbsp;</div>
        <div style="float:left;width:250px">
            <p>Remarks</p>
            <div class="input-control text"><input type="text" name="remarks" class="skippable" tabindex="4" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>            
            <p>&nbsp;</p>
            <p style="text-align:right;"><input type="submit" name="submit" value="Save" tabindex="5" /></p>            
        </div>
    </form>
</div>
</div>
</div>
<?php include 'footer.html'; ?>
