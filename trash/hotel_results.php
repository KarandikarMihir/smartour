<?php include 'header.html'; ?>
<?php include 'functions.php'; ?>
<?php SecurityCheck(); ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Search Results</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float:left;width:95%;height:340px;overflow:auto;">
        <table  class="hovered" style="width:100%">
            <?php
            $SearchParam = $_REQUEST['KEY'];
            dbConnect();
            if(is_numeric($SearchParam))
            {
                $result = mysql_query("SELECT srno, name, city, landline FROM hotellist WHERE srno=$SearchParam ORDER BY srno Asc;");
            }
            else
            {
                $result = mysql_query("SELECT srno, name, city, landline FROM hotellist WHERE name LIKE '%$SearchParam%' ORDER BY srno Asc;");
            } 
            if(!mysql_num_rows($result))
            {
                echo '<tr><td colspan="4" align="center"><h3>***No Records Found***</h3></td></tr>';
                echo '</table>';
            }
            else
            {
                echo '<tr><td colspan="5" style="text-align:right;color:green;">' . mysql_num_rows($result) . ' matching result(s) found</td></tr>';
                echo '<tr><td style="width:50px;font-weight:bold;">No.</td><td style="width:200px;font-weight:bold;">Name</td><td style="width:150px;font-weight:bold;">City</td><td style="width:150px;font-weight:bold;">Landline</td><td style="width:150px;font-weight:bold;">Action</td></tr>';
		while($row = mysql_fetch_array($result))
		{
                    echo '<tr>';
                    echo '<td>' . $row['srno'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['city'] . '</td>';
                    echo '<td>' . $row['landline'] . '</td>';
                    echo '<td><a href="hotel_view.php?KEY=' . $row['srno'] . '">View</a></td>';
                    echo '</tr>';
		}
            }
            mysql_free_result($result);
            ?>
        </table>
    </div>
</div>
<?php include 'footer.html'; ?>