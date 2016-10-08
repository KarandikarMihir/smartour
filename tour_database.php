<?php include 'header.php'; ?>
<?php
if ($_POST) {
    dbConnect();
    
    $Name = $_POST['tourname'];
    $Altname = $_POST['altname'];
    $Price = $_POST['price'];
    $STax = $Price*0.035;
    $Price = $Price;
    $Seats = $_POST['seats'];
    $Date = $_POST['date'];
    $uid = namei($_COOKIE['SmarTourID']);
    mysql_query("INSERT INTO tour (name, altname, price, stax, seats, seats_available, tourdate) values('$Name', '$Altname', $Price, $STax, $Seats, $Seats, '$Date')") or die(mysql_error());
    
    echo '<meta http-equiv="refresh" content="0; url=tour_database.php">';
    die();
}
?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Tour Database</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <div class="pure-g" style="height: 370px;">
        <div class="pure-u-1-4" style="padding-right: 10px;">
            <form method="post" action="tour_database.php" novalidate="novalidate">
                <div>
                    <p>Tour Name</p>
                    <div class="input-control text"><input type="text" name="tourname" tabindex="1" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                    <p>Alternate Name</p>
                    <div class="input-control text"><input type="text" name="altname" class="skippable" tabindex="2" autofocus spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                    
                    <div class="pure-g">
                        <div class="pure-u-1-2" style="padding-right: 10px;">
                            <p>Price</p>
                            <div class="input-control text"><input type="text" name="price" tabindex="3" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                            
                        </div>
                        <div class="pure-u-1-2" style="padding-left: 10px;">
                            <p>Service Tax</p>
                            <div class="input-control text"><input type="text" name="stax" value="14%" readonly="readonly" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>                            
                        </div>
                    </div>
                    <div class="pure-g">
                        <div class="pure-u-1-2" style="padding-right: 10px;">
                            <p>Tour Date</p>
                            <div class="input-control text"><input type="date" name="date" maxlength="10" tabindex="4" placeholder="yyyy-mm-dd" value="2015-10-11" style="width: 100%; height:32px;"   spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"/></div>
                        </div>
                        <div class="pure-u-1-2" style="padding-left: 10px;">
                            <p>No. of seats</p>
                            <div class="input-control text"><input type="number" name="seats" tabindex="5" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /></div>
                        </div>
                    </div>                    
                    <input type="submit" tabindex="6" value="Save" style="margin: 0;float: right;" />
                </div>
            </form>            
        </div>
        <div class="pure-u-3-4" style="padding-left: 10px;max-height: 350px;overflow: auto;">
            <div>
                <?php
                dbConnect();
                $result = mysql_query("SELECT srno, name, altname, price, stax, seats, seats_available as seats_av FROM tour ORDER BY srno DESC") or die(mysql_error());
                ?>
                <table  class="hovered" style="width:100%">
                    <?php
                    if(!mysql_num_rows($result))
                    {
                        echo '<tr><td colspan="5" align="center"><h3>***No Records Found***</h3></td></tr>';
                        echo '</table>';
                    }
                    else
                    {
                        echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Price</b></td><td><b>S. Tax</b></td><td><b>Seats</b></td><td colspan="3"><b>Action</b></td></tr>';
                        while($row = mysql_fetch_array($result))
                        {
                            echo '<tr>';
                            echo '<td>' . $row['srno'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['price'] . '</td>';
                            echo '<td>' . $row['stax'] . '</td>';
                            echo '<td>' . $row['seats_av'] . '</td>';
                            echo '<td><a href="tour_database_update_form.php?KEY=' . $row['srno'] . '">Update</a></td>';
                            echo '<td><a href="tour_delete_action.php?KEY=' . $row['srno'] . '">Delete</a></td>';
                            echo '<td><a href="tour_chart.php?KEY=' . $row['srno'] . '" target="_blank">Print Chart</a></td>';
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