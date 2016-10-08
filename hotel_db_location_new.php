<?php include 'header.php'; ?>
<?php
if ($_POST)
{
    dbConnect(); 
    $CityName = SafeString($_POST['CityName']);
    $StateName = SafeString($_POST['StateName']);
    mysql_query("INSERT INTO citylist VALUES('" . $CityName . "','" . $StateName . "')") or die(mysql_error());
    //header('location: location.php');
    echo '<meta http-equiv="refresh" content="0; url=location.php">';
}
?>
	<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px">Add New Location</h1></div>
	<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
	<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px;">
            <form method="post" action="hotel_db_location_new.php" novalidate="novalidate">
            <?php
            dbConnect();
            $result = mysql_query("SELECT statename FROM statelist ORDER BY statename ASC") or die(mysql_error());
            ?>
            <div style="float:left;width:260px">
                <p>New Location</p>
                <div class="input-control text">
                    <input type="text" class="validate-name" style="width:250px;" maxlength="50" autofocus  name="CityName" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/>
                </div>
                <p>Select State</p>
                <div class="input-control select">
                    <select style="width:250px;" name="StateName">
                        <?php
                        while($row = mysql_fetch_row($result))
                        {
                            foreach($row as $cell)
                            {
                                if($cell!=$ID)
                                    echo '<option>' . $cell . '</option>';
                            }
                        }
                        mysql_free_result($result);
                        ?>
                    </select>
                </div>
                <p style="text-align:right;padding-top: 10px;"><input type="submit" name="submit" value="Add" ></p>
            </div>
            </form>
	</div>
	</div>
<?php include 'footer.html'; ?>