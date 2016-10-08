<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=hotel_update.php">';
    die();
}

    dbConnect();
    $result = mysql_query("SELECT hotellist.name as hname, citylist.name as cname FROM hotellist, citylist WHERE hotellist.srno=" . $KEY . " AND hotellist.cityid=citylist.srno") or die(mysql_error());
    if(!mysql_num_rows($result)){
        echo '<meta http-equiv="refresh" content="0; url=hotel_update.php">';
        die();
    }
    $row = mysql_fetch_array($result);
    mysql_free_result($result);
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Delete Photos</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div id="policytext" style="width:100%;height:340px;overflow:auto;">
        <p style="padding: 10px;margin-bottom: 25px;background: #ffebeb;border: solid 1px #FF0000;width: 95%;"><span class="label important">Important!</span> Photos of <b><?php echo $row['hname'] . ', ' . $row['cname']; ?></b>. Click to delete.</p>
    <?php
    $result=mysql_query("SELECT * FROM imagelist WHERE hid=$KEY") or die(mysql_error());
    if(!mysql_num_rows($result)){
        echo '<meta http-equiv="refresh" content="0; url=hotel_update.php">';
        die();
    }    
    while($row=mysql_fetch_array($result))
    {
        echo '<div style="width:40%;float:left;">';
        echo '<a href="hotel_delete_photos_action.php?PATH=' . $row['imagepath'] . '&KEY=' . $row['hid'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;"><img src="' . $row['imagepath'] . '" width="90%" title="' . $row['caption'] . ': Click to delete" /></a>';
        echo '</div>';
    }
    mysql_free_result($result);
    ?>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>
