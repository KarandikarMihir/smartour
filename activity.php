<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Activity Log</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div id="resultset" style="float:left;width:95%;height:340px;overflow:auto;">
        <table  class="hovered" style="width:100%">
	<?php
        dbConnect();
        $result = mysql_query("SELECT * FROM activitylog ORDER BY srno Desc;") or die(mysql_error());
        if(!mysql_num_rows($result))
	{
            echo '<tr><td colspan="4" align="center"><h3>***No Records Found***</h3></td></tr>';
            echo '</table>';
	}
        else
        {
            if(decrypt($_COOKIE['Privileges'], $Salt)=="Administrator")
                echo '<tr><td colspan="4" style="text-align: right;"><i class="icon-remove"></i><a href="javascript:;" onclick="if(confirm(\'Click OK to confirm action\')){ deleteRecord(\'clearActivity\',\'request.php\',\'True\',\'resultset\'); } else return false;">Clear Log</a></td></tr>';
            echo '<tr><td style="width:50px;font-weight:bold;">No.</td><td style="width:200px;font-weight:bold;">Description</td><td style="width:150px;font-weight:bold;">Time Stamp</td><td style="width:150px;font-weight:bold;">User Name</td></tr>';
            while($row = mysql_fetch_array($result))
            {
                echo '<tr>';
                echo '<td>' . $row['srno'] . '</td>';
                echo '<td>' . $row['activity'] . '</td>';
                echo '<td>' . $row['timestamp'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '</tr>';
            }
	}
        ?>
        </table>
    </form>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>