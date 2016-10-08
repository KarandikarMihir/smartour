<?php include 'header.php'; ?>
<?php
$KEY = $_GET['KEY'];
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;"><?php echo $KEY; ?></h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div id="conversation" style="width: 100%;height: 340px;overflow: auto;">
    <?php
    dbConnect();
    $thisguy = decrypt($_COOKIE['Identification'], $Salt);
    $thatguy = $KEY;
    $result = mysql_query("SELECT * FROM messenger WHERE (recipient = '" . $thatguy . "' AND sender = '" . $thisguy . "') OR (sender = '" . $thatguy . "' AND recipient = '" . $thisguy . "')") or die(mysql_error());
    while($row = mysql_fetch_array($result))
    {
        if($row['sender']==$thisguy){
            echo '<p class="thisguy"><b>' . $row['sender'] . '</b><br /><br />' . $row['message'] . '</p>';
        }
        else{
            echo '<p class="thatguy"><b>' . $row['sender'] . '</b><br /><br />' . $row['message'] . '</p>';
        }
    }	
    mysql_query("UPDATE messenger set readstatus=1 WHERE (recipient = '" . $thatguy . "' AND sender = '" . $thisguy . "') OR (sender = '" . $thatguy . "' AND recipient = '" . $thisguy . "')") or die(mysql_error());
    ?>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>