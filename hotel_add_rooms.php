<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=hotel_rooms.php">';
    die();
}
if ($_POST)
{
    dbConnect();
    $RoomType = SafeString($_POST['roomtype']); 
    $PaxNos = SafeString($_POST['paxnos']);
    $ExtraPax = SafeString($_POST['extrapax']);
    $Rate = SafeString($_POST['rate']);
    mysql_query("INSERT INTO roomlist (roomtype,paxnos,extrapax,rate,hid) VALUES('" . $RoomType . "'," . $PaxNos . "," . $ExtraPax . "," . $Rate . "," . $KEY . ")") or die(mysql_error());
    //header('location: hotel_add_rooms.php?KEY=' . $KEY);
    echo '<meta http-equiv="refresh" content="0; url=hotel_add_rooms.php?KEY=' . $KEY . '">';
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Room Details</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <?php
    dbConnect();
    $result = mysql_query("SELECT hotellist.name as hname, citylist.name as cname FROM hotellist, citylist WHERE hotellist.srno=$KEY AND hotellist.cityid=citylist.srno") or die(mysql_error());
    if(!mysql_num_rows($result)){
        echo '<meta http-equiv="refresh" content="0; url=hotel_rooms.php">';
        die();
    }
    $row = mysql_fetch_array($result);
    $HotelName = $row['hname'] . ', ' . $row['cname'];
    ?>
    <p style="padding: 10px;margin-bottom: 25px;background: #ebebff;border: solid 1px #0000ff;width: 95%;"><span class="label info">Note</span> You are updating rooms of <b><?php echo $HotelName ?></b>. <a href="hotel_add_photos.php?KEY=<?php echo $KEY; ?>" style="margin-left: 50px;">Redirect to Photo Uploader</a> <i class="icon-new-tab"></i></p>    
    <form method="post" action="hotel_add_rooms.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
        <table style="width: 95%;">
            <tr>
                <td style="width: 25%;">Room Type</td>
                <td style="padding: 8px;"><div class="input-control text" style="margin: 0;"><input type="text" class="validate-name" style="width:250px;" autofocus name="roomtype" maxlength="20" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div></td>
            </tr>
            <tr>
                <td>No. of persons allowed</td>
                <td style="padding: 8px;"><div class="input-control text" style="margin: 0;"><input type="number" style="width:250px;" name="paxnos" min="1" max="30" maxlength="3" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div></td>
            </tr>
            <tr>
                <td>Extra persons</td>
                <td style="padding: 8px;"><div class="input-control text" style="margin: 0;"><input type="number" style="width:250px;" name="extrapax" min="0" max="5" maxlength="3" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div></td>
            </tr>
            <tr>
                <td>Rate Rs.</td>
                <td style="padding: 8px;"><div class="input-control text" style="margin: 0;"><input type="text" class="amt" style="width:250px;" maxlength="10" name="rate" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div></td>
            </tr>
            <tr>
                <td>Action</td>
                <td style="padding: 8px;"><input type="submit" name="submit" value="Add" style="margin: 0;"></td>
            </tr>            
        </table>
    </form>
</div>
</div>
<?php include 'footer.html'; ?>
