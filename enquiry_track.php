<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Enquiry Track</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float:left;width:95%;height:340px;overflow:auto;">
        <table  class="hovered" style="width:100%">
	<?php
        dbConnect();
        $result = mysql_query("SELECT enquiry.srno, customer.name, enquiry.destination, customer.landline, customer.mobile, enquiry.applock FROM enquiry, customer WHERE enquiry.cid=customer.srno ORDER BY enquiry.srno Desc;") or die(mysql_error());
        $total = mysql_num_rows(mysql_query("SELECT * FROM enquiry"));
        $success = mysql_num_rows(mysql_query("SELECT * FROM enquiry where applock=1"));
        if($total)
            $percentage = ($success / $total) * 100;
        if(!mysql_num_rows($result))
	{
            echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
            echo '</table>';
	}
        else
        {
            if($percentage<50){
                echo '<tr><td colspan="6" style="text-align:right;color:red;"><b>' . round($percentage, 2) . '% successful enquiries</b></td></tr>';
            }
            else{
                echo '<tr><td colspan="6" style="text-align:right;color:green;"><b>' . round($percentage, 2) . '% successful enquiries</b></td></tr>';
            }
            echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Destination</b></td><td><b>Landline</b></td><td><b>Mobile</b></td><td><b>Status</b></td></tr>';
            while($row = mysql_fetch_array($result))
            {
                echo '<tr>';
                echo '<td>' . $row['srno'] . '</td>';
                echo '<td><a href="enquiry_view.php?KEY=' . $row['srno'] . '">' . $row['name'] . '</a></td>';
                echo '<td>' . $row['destination'] . '</td>';
                echo '<td>' . $row['landline'] . '</td>';
                echo '<td>' . $row['mobile'] . '</td>';
                echo '<td>';
                if($row['applock']==1)
                    echo '<span class="label success">Hatched</span></td>';
                else
                    echo '<span class="label warning">Unhatched</span></td>';
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