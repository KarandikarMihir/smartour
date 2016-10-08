<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">100 Tours Program</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float:left;width:40%">
        <h2>Task Pane</h2>
        <hr align="left" style="width:80%">
        <div class="page-sidebar" style="width:80%;height:auto;">
            <ul>
                <li class="sticker sticker-color-green"><a href="tour_booking.php"><i class="icon-bus"></i><span style="padding: 5px 20px 5px 10px;">Tour Booking</span></a></li>
                <li class="sticker sticker-color-red"><a href="tour_booking_receipt.php"><i class="icon-keyboard"></i><span style="padding: 5px 20px 5px 10px;">Booking Receipt</span></a></li>
                <li class="sticker sticker-color-yellow"><a href="tour_database.php"><i class="icon-cog"></i><span style="padding: 5px 20px 5px 10px;">Tour Database</span></a></li>
            </ul>
        </div>
    </div>
    <div style="padding-top:10px;">
        <div class="input-control text" style="width:55%;float:left;">
            <input type="text" name="searchparam" class="with-helper" onKeyUp="loadResults('resultset','tourResults','request.php',this.value)" placeholder="Serial number or name" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" maxlength="40" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><button class="btn-search"></button>
        </div>
    </div>    
    <div id="resultset" style="float:left;width:55%;height:300px;overflow:auto;">
        <?php
        dbConnect();
        $result = mysql_query("SELECT srno, name, price, seats, seats_available as seats_av FROM tour ORDER BY srno DESC") or die(mysql_error());
	?>
        <table  class="hovered" style="width:100%">
            <?php
            if(!mysql_num_rows($result))
            {
                echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
		echo '</table>';
            }
            else
            {
                echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Price</b></td><td><b>Seats</b></td><td><b>Available</b></td></tr>';
                while($row = mysql_fetch_array($result))
                {
                    echo '<tr>';
                    echo '<td>' . $row['srno'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['price'] . '</td>';
                    echo '<td>' . $row['seats'] . '</td>';
                    echo '<td>' . $row['seats_av'] . '</td>';
                    echo '</tr>';
		}
                mysql_free_result($result);
            }
        ?>
        </table>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>