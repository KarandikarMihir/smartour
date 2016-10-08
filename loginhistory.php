<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Login History</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float:left;width:95%;height:340px;overflow:auto;">
        <table  class="hovered" style="width:100%">
            <?php
            dbConnect();
            $result = mysql_query("SELECT * FROM loginhistory ORDER BY srno DESC");
            if(!mysql_num_rows($result))
            {
                echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
		echo '</table>';
            }
            else
            {
                echo '<tr><td style="width:50px;font-weight:bold;">No.</td><td style="width:150px;font-weight:bold;">Username</td><td style="width:350px;font-weight:bold;">Time Stamp</td><td style="width:200px;font-weight:bold;">Attempt</td></tr>';
		$i=0;
                while($row = mysql_fetch_array($result))
		{
                    if($row['attempt']=="Rejected")
                        echo '<tr class="error">';
                    else
                        echo '<tr>';
                    echo '<td>' . $row['srno'] . '</td>';
                    $uname = iname ($row[uid]);
                    echo '<td>' . $uname . '</td>';
                    echo '<td>' . $row['timestamp'] . '</td>';
                    if($row['attempt'] == 1)
                    echo '<td> Success </td>';
                    echo '</tr>';
		}
            }
            mysql_free_result($result);
            ?>
        </table>
    </form>
    </div>
</div>
</div>
<?php include 'footer.html'; ?>