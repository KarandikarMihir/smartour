<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Update Tour Booking</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float:left;width:95%;height:340px;overflow:auto;">
        <table  class="hovered" style="width:100%">
	<?php
        dbConnect();
        $result = mysql_query("SELECT application_tour.srno, customer.name as cname, tour.name as tname FROM application_tour, tour, customer WHERE application_tour.tid=tour.srno AND application_tour.cid=customer.srno ORDER BY application_tour.srno DESC") or die(mysql_error());
        if(!mysql_num_rows($result))
        {
            echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
            echo '</table>';
        }
        else
        {
            echo '<tr><td colspan="6" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' booking(s) in the list</td></tr>';
            echo '<tr><td style="width:50px;"><b>No.</b></td><td style="width:200px;"><b>Name</b></td><td style="width:150px;"><b>Tour Name</b></td><td colspan="3" style="width:150px;"><b>Action</td></tr>';
            
            while($row = mysql_fetch_array($result))
            {
                echo '<tr>';
                echo '<td>' . $row['srno'] . '</td>';
                echo '<td>' . $row['cname'] . '</td>';
                echo '<td>' . $row['tname'] . '</td>';
                echo '<td><a href="tour_booking_update_form.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Update Info</a></td>';
                echo '<td><a href="tour_booking_list_new.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Update Tourist List</a></td>';
                echo '</tr>';
            }
        }
        mysql_free_result($result);
        ?>
        </table>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>