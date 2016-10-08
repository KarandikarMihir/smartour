<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Delete Tour Booking</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div id="resultset" style="float:left;width:95%;height:340px;overflow:auto;">
        <?php
        dbConnect();
        $result = mysql_query("SELECT application_tour.srno, customer.name as cname, tour.name as tname, tour.price, tour.stax, application_tour.seats FROM customer, tour, application_tour WHERE application_tour.cid=customer.srno and application_tour.tid=tour.srno ORDER BY application_tour.srno DESC;") or die(mysql_error());
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
                echo '<tr><td style="width:50px;"><b>No.</b></td><td style="width:200px;"><b>Name</b></td><td style="width:200px;"><b>Tour Name</td><td style="width:150px;"><b>Seats</td><td style="width:150px;"><b>Amount</td><td style="width:150px;font-weight:bold;">Action</td></tr>';
                while($row = mysql_fetch_array($result))
                {
                    echo '<tr>';
                    echo '<td>' . $row['srno'] . '</td>';
                    echo '<td>' . $row['cname'] . '</td>';
                    echo '<td>' . $row['tname'] . '</td>';
                    echo '<td>' . $row['seats'] . '</td>';
                    echo '<td>' . number_format((($row['seats']*$row['price'])+($row['seats']*$row['stax'])),2) . '</td>';
                    echo '<td><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'delTourBooking\',\'request.php\',\'' . $row['srno'] . '\',\'resultset\'); } else return false;">Delete</a></td>';
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