<?php include 'header.php'; ?>
<div id="page-header" style="background-color:#eff4ff;width:100%;height:70px;"><span style="padding-left:30px;"><a href="javascript:history.go(-1)"><img src="images/back.png" width="30px" height="30px" alt=""></a></span><h1 style="display:inline;padding-left:10px;">Database Management</h1></div>
<div id="Margine" style="background-color:#eff4ff;width:100%;height:20px"></div>
<div id="content" style="background-color:#eff4ff;height:380px;width:100%;display:inline-block;padding-left:70px">
    <div style="float:left;width:35%">
        <h2>Task Pane</h2>
        <hr align="left" style="width:80%">
        <div class="page-sidebar" style="width:80%;height:auto;">
            <ul>
                <li class="sticker sticker-color-darken"><a href="dbms_contest.php"><i class=" icon-lightning"></i><span style="padding: 5px 20px 5px 10px;">Test Connection</span></a></li>
                <li class="sticker sticker-color-yellow"><a href="<?php if(decrypt($_COOKIE['Privileges'], $Salt)=='Administrator'){echo 'dbms_backup.php'; } else{echo 'javascript:;';} ?>"><i class=" icon-download-2"></i><span style="padding: 5px 20px 5px 10px;">Create Archive</span></a></li>
                <li class="sticker sticker-color-red"><a href="<?php if(decrypt($_COOKIE['Privileges'], $Salt)=='Administrator'){echo 'dbms_cloud.php'; } else{echo 'javascript:;';} ?>"><i class=" icon-cloudy-2"></i><span style="padding: 5px 20px 5px 10px;">Cloud Storage</span></a></li>
                <li class="sticker sticker-color-green"><a href="<?php if(decrypt($_COOKIE['Privileges'], $Salt)=='Administrator'){echo 'dbms_upload.php'; } else{echo 'javascript:;';} ?>"><i class="icon-upload-3"></i><span style="padding: 5px 20px 5px 10px;">Restore Database</span></a></li>
                <li class="sticker sticker-color-purple"><a href="<?php if(decrypt($_COOKIE['Privileges'], $Salt)=='Administrator'){echo 'dbms_wipedata.php'; } else{echo 'javascript:;';} ?>" onclick="<?php if(decrypt($_COOKIE['Privileges'], $Salt)=='Administrator'){echo 'return confirm(\'You are about to erase the entire database. Click OK to confirm.\')';} ?>"><i class="icon-book"></i><span style="padding: 5px 20px 5px 10px;">Wipe Database</span></a></li>
            </ul>
        </div>
    </div>
    <div style="float:left;width:60%;height:340px;overflow:auto;">
        <table  class="hovered" style="width:100%">
        <?php
        dbConnect();
        $result = mysql_query("SELECT srno, username, timestamp, description FROM dbactivity ORDER BY srno DESC;") or die(mysql_error());
        if(!mysql_num_rows($result))
        {
            echo '<tr><td colspan="3" align="center"><h3>***No Records Found***</h3></td></tr>';
            echo '</table>';
        }
        else
        {
            echo '<tr><td style="width:50px;font-weight:bold;">No.</td><td style="width:100px;font-weight:bold;">Username</td><td style="width:250px;font-weight:bold;">Time Stamp</td><td style="width:100px;font-weight:bold;">Activity</td></tr>';
            while($row = mysql_fetch_array($result))
            {
                echo '<tr>';
                echo '<td>' . $row['srno'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['timestamp'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
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