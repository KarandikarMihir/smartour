<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Update Hotel</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="padding: 10px 10px 10px 0;">
        <div class="input-control text" style="width:36%;float:left;">
            <input type="text" name="searchparam" class="with-helper" onKeyUp="loadResults('resultset','hotelUpdateResults','request.php',this.value)" placeholder="Serial number or name of hotel" style="font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;" maxlength="40" required spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" /><button class="btn-search"></button>
        </div>
    </div>    
    <div id="resultset" style="float:left;width:95%;height:340px;overflow:auto;">
        <table  class="hovered" style="width:100%">
	<?php
        dbConnect();
        $result = mysql_query("SELECT hotellist.srno, hotellist.name, citylist.name as cityname FROM hotellist, citylist WHERE hotellist.cityid=citylist.srno ORDER BY srno Desc;");
        if(!mysql_num_rows($result))
        {
            echo '<tr><td align="center"><h3>***No Records Found***</h3></td></tr>';
            echo '</table>';
        }
        else
        {
            echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>City</b></td><td colspan="3"><b>Action</b></td></tr>';
            
            while($row = mysql_fetch_array($result))
            {
                echo '<tr>';
                echo '<td>' . $row['srno'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['cityname'] . '</td>';
                echo '<td><a href="hotel_update_form.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Update Info</a></td>';
                echo '<td><a href="hotel_add_photos.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Add Photos</a></td>';
                echo '<td><a href="hotel_delete_photos.php?KEY=' . $row['srno'] . '" onclick="if(confirm(\'Click OK to confirm action\')) return true; else return false;">Delete Photos</a></td>';
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