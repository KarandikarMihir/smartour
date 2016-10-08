<?php include 'header.php'; ?>
<?php
if(isset($_GET['KEY']) && is_whole($_GET['KEY'])){
    $KEY = $_GET['KEY'];
}
else{
    echo '<meta http-equiv="refresh" content="0; url=tour_booking.php">';
    die();
}
if ($_POST) {
    dbConnect();
    $result1=  mysql_query("SELECT seats FROM application_tour WHERE srno=$KEY") or die(mysql_error());
    $result2 = mysql_query("SELECT COUNT(*) as count FROM application_tour_list WHERE taid=$KEY") or die(mysql_error());
    $row1=  mysql_fetch_array($result1);
    $row2=  mysql_fetch_array($result2);
    if($row1['seats']>$row2['count']+1){
        $Name = $_POST['name'];
        $Area = $_POST['area'];
        $Email = $_POST['email'];
        $Contact = $_POST['contact'];
        mysql_query("INSERT INTO application_tour_list (name, area, email, contact, taid) values('$Name', '$Area', '$Email', '$Contact', $KEY)") or die(mysql_error());
    }
    
    echo '<meta http-equiv="refresh" content="0; url=tour_booking_list_new.php?KEY=' . $KEY . '">';
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Tourist List</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div class="pure-g" style="height: 370px;">
        <div class="pure-u-1-4" style="padding-right: 10px;">
            <?php
            dbConnect();
            $result = mysql_query("SELECT customer.name as cname, tour.name as tname, application_tour.seats FROM application_tour, tour, customer WHERE application_tour.srno=$KEY AND customer.srno=application_tour.cid AND tour.srno=application_tour.tid") or die(mysql_error());
            $row=  mysql_fetch_array($result);
            $seats=$row['seats'];
            
            $result_ = mysql_query("SELECT srno, name, area, contact, email FROM application_tour_list WHERE taid=$KEY ORDER BY srno DESC") or die(mysql_error());
            if((mysql_num_rows($result_)+1)==$seats){
                $error='disabled="disabled"';
            }
            ?>            
            <form method="post" action="tour_booking_list_new.php?KEY=<?php echo $KEY; ?>" novalidate="novalidate">
                <div>
                    <p>Name</p>
                    <div class="input-control text"><input type="text" name="name" tabindex="1" <?php if(isset($error)) echo $error; ?> spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                    <p>Area</p>
                    <div class="input-control text"><input type="text" name="area" tabindex="2" <?php if(isset($error)) echo $error; ?> spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                    <p>Email</p>
                    <div class="input-control text"><input type="email" tabindex="3" class="validate-email skippable" name="email" <?php if(isset($error)) echo $error; ?> spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                    <p>Contact</p>
                    <div class="input-control text"><input type="text" name="contact" class="skippable" <?php if(isset($error)) echo $error; ?> tabindex="4" maxlength="50" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                    <p>&nbsp;</p>
                    <p style="text-align:right;"><input type="submit" tabindex="5" <?php if(isset($error)) echo $error; ?> value="Save" style="margin: 0;" /></p>
                </div>
            </form>            
        </div>
        <div class="pure-u-3-4" style="padding-left: 10px;max-height: 350px;overflow: auto;">
            <div id="resultset">
                <p style="padding-bottom: 5px;border-bottom: 2px dotted #ccc;"><span style="margin-right: 20px;"><b>Name on Booking: </b><?php echo $row['cname']; ?></span><span style="margin-right: 20px;"><b>Tour Name: </b><?php echo $row['tname']; ?></span><span><b>Total no. of seats: </b><?php echo $row['seats']; ?> (Including <?php echo $row['cname']; ?>)</span></p>
                <table  class="hovered" style="width:100%">
                    <?php
                    if(!mysql_num_rows($result_))
                    {
                        echo '<tr><td colspan="5" align="center"><h3>***No Records Found***</h3></td></tr>';
                        echo '</table>';
                    }
                    else
                    {
                        $i=0;
                        echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Area</b></td><td><b>Contact</b></td><td><b>Email</b></td><td><b>Action</b></td></tr>';
                        while($row = mysql_fetch_array($result_))
                        {
                            $i++;
                            echo '<tr>';
                            echo '<td>' . $i . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['area'] . '</td>';
                            echo '<td>' . $row['contact'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'delTourListItem\',\'request.php\',\'' . $row['srno'] . '\',\'resultset\'); } else return false;">Delete</a></td>';
                            echo '</tr>';
                        }
                        mysql_free_result($result);
                    }
                ?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>