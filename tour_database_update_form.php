<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
    dbConnect();
    $result=  mysql_query("SELECT * FROM tour WHERE srno=$KEY") or die(mysql_error());
    if(mysql_num_rows($result)){
        $row=  mysql_fetch_array($result);
        $Price=$row['price'];
        $STax=$row['stax'];
        $Price=$Price+$STax;
    }
    else{
        echo '<meta http-equiv="refresh" content="0; url=tour_database.php">';
        die();        
    }
}
else{
    echo '<meta http-equiv="refresh" content="0; url=tour_database.php">';
    die();
}
if ($_POST) {
    dbConnect();
    
    $Name = $_POST['tourname'];
    $Altname = $_POST['altname'];
    $Price = $_POST['price'];
    $STax = $Price*0.035;
    $Price = $Price - $STax;
    $Seats = $_POST['seats'];
    $Date = $_POST['date'];
    mysql_query("UPDATE tour SET name='$Name', altname='$Altname', price=$Price, stax=$STax, seats=$Seats, seats_available=$Seats, tourdate='$Date' WHERE srno=$KEY") or die(mysql_error());
    echo '<meta http-equiv="refresh" content="0; url=tour_database.php">';
    die();
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Tour Database</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div class="pure-g" style="height: 370px;">
        <div class="pure-u-1-4" style="padding-right: 10px;">
            <form method="post" action="tour_database_update_form.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
                <div>
                    <p>Tour Name</p>
                    <div class="input-control text"><input type="text" name="tourname" value="<?php echo $row['name']; ?>" tabindex="1" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                    <p>Alternate Name</p>
                    <div class="input-control text"><input type="text" name="altname" value="<?php echo $row['altname']; ?>" tabindex="2" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                    
                    <div class="pure-g">
                        <div class="pure-u-1-2" style="padding-right: 10px;">
                            <p>Price</p>
                            <div class="input-control text"><input type="text" name="price" value="<?php echo $Price; ?>" tabindex="3" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                            
                        </div>
                        <div class="pure-u-1-2" style="padding-left: 10px;">
                            <p>Service Tax</p>
                            <div class="input-control text"><input type="text" name="stax" value="14%" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                            
                        </div>
                    </div>
                    <div class="pure-g">
                        <div class="pure-u-1-2" style="padding-right: 10px;">
                            <p>Tour Date</p>
                            <div class="input-control text"><input type="date" name="date" maxlength="10" value="<?php echo $row['tourdate']; ?>" tabindex="4" placeholder="yyyy-mm-dd" value="2015-10-11" style="width: 100%; height:32px;"   spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
                        </div>
                        <div class="pure-u-1-2" style="padding-left: 10px;">
                            <p>No. of seats</p>
                            <div class="input-control text"><input type="number" name="seats" value="<?php echo $row['seats']; ?>" tabindex="5" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                        </div>
                    </div>                    
                    <input type="submit" tabindex="6" value="Update" style="margin: 0;float: right;" />
                </div>
            </form>            
        </div>
    </div>
</div>
</div>
</div>
<?php include 'footer.html'; ?>