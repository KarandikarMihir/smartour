<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Cancellation</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:384px;width:100%;display:inline-block;padding-left:70px">
    <p style="padding: 10px;margin-bottom: 25px;background: #ebebff;border: solid 1px #0000ff;width: 95%;"><span class="label info">Note</span> Please note that this action cannot be reverted.</p>
    <div style="float:left;width:95%;height:340px;overflow:auto;">
        <table  class="hovered" style="width:100%">
	<?php
        dbConnect();
        $result = mysql_query("SELECT srno, name, hotelname, chkin, chkout FROM application WHERE cancelflag=0 ORDER BY srno DESC;") or die(mysql_error());
        if(!mysql_num_rows($result))
	{
            echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
            echo '</table>';
	}
        else
        {
            echo '<tr><td style="width:50px;font-weight:bold;">No.</td><td style="width:200px;font-weight:bold;">Name</td><td style="width:150px;font-weight:bold;">Destination</td><td style="width:150px;font-weight:bold;">Landline</td><td style="width:150px;font-weight:bold;">Mobile</td><td style="width:150px;font-weight:bold;">Action</td></tr>';
            while($row = mysql_fetch_array($result))
            {
                echo '<tr>';
                echo '<td>' . $row['srno'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['hotelname'] . '</td>';
                echo '<td>' . $row['chkin'] . '</td>';
                echo '<td>' . $row['chkout'] . '</td>';
                echo '<td><a href="cancellation_new.php?KEY=' . $row['srno'] . '">Select</a></td>';
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